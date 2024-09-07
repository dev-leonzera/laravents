<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Inscrito;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $eventos = Evento::count();
        $inscritos = Inscrito::count();
        $proximoEvento = Evento::where('data_inicio', '>=', now())
                               ->orderBy('data_inicio', 'asc')
                               ->first();

        return view('home', compact('eventos', 'inscritos', 'proximoEvento'));
    }
}
