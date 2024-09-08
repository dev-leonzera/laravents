<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Inscrito;
use App\Models\TipoInscricao;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InscritosExport;

class InscritoController extends Controller
{
    public function pageEvento($slug)
    {
        $evento = Evento::where('slug', $slug)->firstOrFail();
        $qnt_inscritos = $evento->inscrito()->count();
        $tiposInscricao = TipoInscricao::all();
        return view('eventos.evento', compact('evento', 'qnt_inscritos', 'tiposInscricao'));
    }

    public function pageForm($id)
    {
        $evento = Evento::findOrFail($id);
        $tipos_inscricao = TipoInscricao::all();
        return view('eventos.inscricao', compact('evento', 'tipos_inscricao'));
    }

    public function formInscricao(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nome' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'evento_id' => 'required|exists:eventos,id',
                'tipos_inscricao_id' => 'required|exists:tipos_inscricao,id',
                'telefone' => 'required|string|max:255',
                'idade' => 'required|integer',
            ]);

            $inscrito = Inscrito::criarInscricao($validatedData);
            $evento = Evento::findOrFail($validatedData['evento_id']);

            return redirect()->route('evento.page', ['slug' => $evento->slug])
                             ->with('success', 'Inscrição realizada com sucesso! Aguarde a aprovação.');
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
        return Excel::download(new InscritosExport($evento_id, $filters), 'inscritos.xlsx');
    }
}
