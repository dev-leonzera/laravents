<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInscricao extends Model
{
    use HasFactory;
    protected $table = 'tipos_inscricao';

    protected $fillable = ['nome', 'numero_vagas', 'valor', 'descricao'];

    public function temVagasDisponiveis()
    {
        return $this->numero_vagas > 0;
    }

    public function decrementarVagas()
    {
        $this->decrement('numero_vagas');
    }

    public function incrementarVagas()
    {
        $this->increment('numero_vagas');
    }
}
