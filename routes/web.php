<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CompanyController;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ActivityController;
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


Route::get('/', [WelcomeController::class, 'home']);


Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');

Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');

Route::resource('/companies', CompanyController::class);

Route::resources([
    '/tags' => TagController::class,
    '/tasks' => TaskController::class
]);

Route::resource('/activities', ActivityController::class)->except([
    'index', 'show'
]);
Route::resource('/contacts.notes', ContactController::class)->shallow();
// Route::resource('/contacts.notes', ContactNoteController::class)->names([
//     'index' => 'activities.all',
//     'show' => 'activities.view'
// ]);


Route::resource('/contacts.notes', ContactNoteController::class)->names([
    'activities' => 'active'
]);
