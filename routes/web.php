<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

use App\Http\Controllers\EventosController;
use App\Http\Controllers\InscritoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TipoInscricaoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/evento/{slug}', [InscritoController::class, 'pageEvento'])->name('evento.page');
Route::get('/evento/{slug}/inscricao', [InscritoController::class, 'pageForm']);
Route::post('/evento/form', [InscritoController::class, 'formInscricao']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::post('users', [UserController::class, 'create'])->name('users.create');
    Route::resource('eventos', EventosController::class);
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('tipos_inscricao', TipoInscricaoController::class);
    Route::get('inscritos/export/{evento_id}', [InscritoController::class, 'export'])->name('inscritos.export');
    Route::get('inscritos/aprovar/{inscrito_id}', [InscritoController::class, 'approveRegistration'])->name('inscritos.aprovar');
    Route::get('inscritos/rejeitar/{inscrito_id}', [InscritoController::class, 'rejectRegistration'])->name('inscritos.rejeitar');
    Route::get('inscritos/visualizar/{inscrito_id}', [InscritoController::class, 'showInscricao'])->name('inscritos.visualizar');
    Route::patch('inscritos/inserir-link-pagamento', [InscritoController::class, 'storePaymentLink'])->name('inscritos.pagamento');
    Route::get('inscritos/confirmar-envio/{inscrito_id}', [InscritoController::class, 'sendConfirm'])->name('inscritos.confirmar');
});
