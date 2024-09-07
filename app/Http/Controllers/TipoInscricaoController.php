<?php

namespace App\Http\Controllers;

use App\Models\TipoInscricao;
use Illuminate\Http\Request;

class TipoInscricaoController extends Controller
{
    public function index()
    {
        $tiposInscricao = TipoInscricao::all();
        return view('tipos_inscricao.index', compact('tiposInscricao'));
    }

    public function create()
    {
        return view('tipos_inscricao.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'numero_vagas' => 'required|integer',
            'valor' => 'required|numeric',
        ]);

        TipoInscricao::create($request->all());

        return redirect()->route('tipos_inscricao.index')
            ->with('success', 'Tipo de inscrição criado com sucesso.');
    }

    public function edit($id)
    {
        $tipoInscricao = TipoInscricao::findOrFail($id);
        return view('tipos_inscricao.edit', compact('tipoInscricao'));
    }

    public function update(Request $request, $id)
    {
        $tipoInscricao = TipoInscricao::findOrFail($id);
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'numero_vagas' => 'required|integer',
            'valor' => 'required|numeric',
        ]);

        $tipoInscricao->update($request->all());

        return redirect()->route('tipos_inscricao.index')
            ->with('success', 'Tipo de inscrição atualizado com sucesso.');
    }

    public function destroy(TipoInscricao $tipoInscricao)
    {
        $tipoInscricao->delete();

        return redirect()->route('tipos_inscricao.index')
            ->with('success', 'Tipo de inscrição excluído com sucesso.');
    }
}
