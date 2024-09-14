<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Inscrito extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 
        'email', 
        'telefone', 
        'idade', 
        'evento_id', 
        'tipos_inscricao_id', 
        'status', 
        'congregacao', 
        'camisa_tipo', 
        'camisa_tamanho', 
        'link_pagamento', 
        'mensagem_enviada',
        'forma_pagamento'
    ];

    public static function criarInscricao(array $dados)
    {
        DB::beginTransaction();
        try {
            $tipoInscricao = TipoInscricao::findOrFail($dados['tipos_inscricao_id']);

            if (!$tipoInscricao->temVagasDisponiveis()) {
                throw new \Exception('Não há mais vagas disponíveis para este tipo de inscrição.');
            }

            $allowedFormaPagamentoValues = ['Cartão de Crédito', 'Pix']; // list of allowed enum values

            if (!in_array($dados['forma_pagamento'], $allowedFormaPagamentoValues)) {
                throw new \Exception('Invalid forma_pagamento value');
            }

            $inscrito = self::create(array_merge($dados, [
                'status' => 'pendente',
                'link_pagamento' => null,
                'mensagem_enviada' => 0,
                'forma_pagamento' => $dados['forma_pagamento']
            ]));
            $tipoInscricao->decrementarVagas();

            DB::commit();
            return $inscrito;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function aprovar()
    {
        $this->update(['status' => 'Aprovado']);
    }

    public function rejeitar()
    {
        DB::transaction(function () {
            $this->update(['status' => 'Rejeitado']);
            $this->tipoInscricao->incrementarVagas();
        });
    }

    public function confirmar(){
        $this->update(['mensagem_enviada' => 1]);
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function tipoInscricao()
    {
        return $this->belongsTo(TipoInscricao::class, 'tipos_inscricao_id');
    }
}
