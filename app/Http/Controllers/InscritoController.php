<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Inscrito;
use App\Models\TipoInscricao;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InscritosExport;
use Carbon\Carbon;

class InscritoController extends Controller
{
    public function pageEvento($slug)
    {
        $evento = Evento::where('slug', $slug)->firstOrFail();
        $tiposInscricao = TipoInscricao::all();
        return view('eventos.evento', compact('evento', 'tiposInscricao'));
    }

    public function pageForm($id)
    {
        $evento = Evento::findOrFail($id);
        $tipos_inscricao = TipoInscricao::all();
        $tipos_camisa = [
            (object) ['id' => 1, 'nome' => 'Masculino', 'value' => 'masculino'],
            (object) ['id' => 2, 'nome' => 'Baby Look', 'value' => 'baby look']
        ];

        $tamanhos_camisa = [
            (object) ['id' => 1, 'nome' => 'PP', 'value' => 'PP'],
            (object) ['id' => 2, 'nome' => 'P', 'value' => 'P'],
            (object) ['id' => 3, 'nome' => 'M', 'value' => 'M'],
            (object) ['id' => 4, 'nome' => 'G', 'value' => 'G'],
            (object) ['id' => 5, 'nome' => 'GG', 'value' => 'GG'],
            (object) ['id' => 6, 'nome' => 'XG', 'value' => 'XG'],
        ];
        return view('eventos.inscricao', compact('evento', 'tipos_inscricao', 'tipos_camisa', 'tamanhos_camisa'));
    }

    public function inscricaoRealizada(TipoInscricao $tipoInscricao)
    {
        return view('eventos.confirm-inscricao', compact('tipoInscricao'));
    }

    public function formInscricao(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nome' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'evento_id' => 'required|exists:eventos,id',
                'tipos_inscricao_id' => 'required|exists:tipos_inscricao,id',
                'congregacao' => 'required',
                'telefone' => 'required|string|max:255',
                'idade' => 'required|integer',
                'camisa_tipo' => 'required',
                'camisa_tamanho' => 'required',
            ]);

            $inscrito = Inscrito::criarInscricao($validatedData);
            $evento = Evento::findOrFail($validatedData['evento_id']);
            $tipoInscricao = $inscrito->tipoInscricao;
            return view('eventos.confirm-inscricao', compact('tipoInscricao', 'evento'));
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ocorreu um erro ao processar sua inscrição: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function approveRegistration($id)
    {
        try {
            $inscrito = Inscrito::findOrFail($id);
            $inscrito->aprovar();
            return redirect()->back()->with('success', 'Inscrição aprovada com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao aprovar inscrição: ' . $e->getMessage());
        }
    }

    public function rejectRegistration($id)
    {
        try {
            $inscrito = Inscrito::findOrFail($id);
            $inscrito->rejeitar();
            return redirect()->back()->with('success', 'Inscrição rejeitada com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao rejeitar inscrição: ' . $e->getMessage());
        }
    }

    public function export(Request $request, $evento_id)
    {
        $filters = $request->only(['status', 'tipo_inscricao']);
        $timestamp = Carbon::now()->format('YmdHis');
        $filename = "inscritos_{$timestamp}.xlsx";
        return Excel::download(new InscritosExport($evento_id, $filters), $filename);
    }

    public function showInscricao($id){
        $inscrito = Inscrito::find($id);
        $mensagem = $this->generateWhatsappUrl($id);
        return view('eventos.show-inscricao', compact('inscrito', 'mensagem'));
    }

    public function generateWhatsappUrl($id)
    {
        $inscrito = Inscrito::findOrFail($id);
        $phone = str_replace(" ", "", $inscrito->telefone);
        $paymentLink = $inscrito->link_pagamento;
        $message = "
Olá, amado(a)! A paz do Senhor!
Estamos felizes com a sua inscrição na Escola Bíblica de Jovens 2024 com o tema Criados para a eternidade. 🙏🏻🎉
Para confirmarmos a sua participação, estamos enviando o link de pagamento para o evento: 
$paymentLink
O pagamento pode ser realizado por pix ou cartão de crédito.
        ";
        $whatsappUrl = "https://api.whatsapp.com/send/?phone=55$phone&text=" . urlencode($message) . "&type=phone_number&app_absent=0";
        return $whatsappUrl;
    }

    public function storePaymentLink(Request $request, Inscrito $inscrito)
    {
        $this->validate($request, [
            'link_pagamento' => 'required|string',
        ]);
        $inscrito = Inscrito::findOrFail($request['inscrito_id']);
        $inscrito->link_pagamento = $request->input('link_pagamento');
        $inscrito->update();

        return redirect()->back()->with('success', 'Link de pagamento salvo com sucesso!');
    }

    public function sendConfirm($id){
        try {
            $inscrito = Inscrito::findOrFail($id);
            $inscrito->confirmar();
            return redirect()->back()->with('success', 'Envio de mensagem confirmado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao confirmar envio: ' . $e->getMessage());
        }        
    }
}
