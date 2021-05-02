<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\UtilisateurController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', [IndexController::class, 'index']);
Route::get('/repondre/{id_form}', [IndexController::class, 'repondre'])->name('respondants');
Route::post('/response', [IndexController::class, 'insert'])->name('insert_response');
Route::post('/getQuestionnaire', [IndexController::class, 'getQuestionnaire'])->name('getQuestionnaire');
Route::post('/getPagination', [IndexController::class, 'getPagination'])->name('getPagination');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'check']);
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function(){
    Route::get('/', [FormsController::class, 'liste']);
    Route::group(['prefix' => 'forms'], function(){
        Route::get('/', [FormsController::class, 'index'])->name('add_form');
        Route::get('liste', [FormsController::class, 'liste'])->name('form');
        Route::get('delete/{id_form}', [FormsController::class, 'delete'])->name('delete');
        Route::post('/', [FormsController::class, 'save']);
    });
    Route::group(['prefix' => 'questionnaire'], function(){
        Route::get('/get/{id_form}', [QuestionnaireController::class, 'index'])->name('questionnaire');
        Route::post('/', [QuestionnaireController::class, 'save'])->name('save_questionnaire');
        Route::get('liste/{id_form}', [QuestionnaireController::class, 'liste'])->name('liste_questionnaire');
        Route::get('modifier/{id_question}', [QuestionnaireController::class, 'modifier'])->name('modifier_question');
        Route::post('modifier/{id_question}', [QuestionnaireController::class, 'update'])->name('update_question');
        Route::get('supprimer/{id_question}', [QuestionnaireController::class, 'delete'])->name('supprimer_question');
    });
    Route::group(['prefix' => 'respondents'], function(){
        Route::get('/', [UtilisateurController::class, 'index'])->name('utilisateurs');
    });
});

Route::get('/logout',function(){
    Auth::logout();
});

Route::get('/clear', function(){
    Session::remove('id_respondats');
});