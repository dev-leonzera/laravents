<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportCamisasExport;
use App\Models\Evento;
use Carbon\Carbon;

class ReportController extends Controller {
    
    public function index(){
        $eventos = Evento::all();
        return view('reports.index', compact('eventos'));
    }

    public function reportCamisas($evento_id){
        $timestamp = Carbon::now()->format('YmdHis');
        $filename = "inscritos_{$timestamp}.xlsx";

        return Excel::download(new ReportCamisasExport($evento_id), $filename);
    }
}