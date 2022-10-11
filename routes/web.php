<?php

use Illuminate\Support\Facades\Route;

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
    $html = "
    <h1>Contact App</h1>
    <div>
        <a href='" . route('contacts.index') . "'>All Contacts</a>
        <a href='" . route('contacts.create') . "'>Add contact</a>
        <a href='" . route('contacts.show', 1) . "'>Show contact</a>
    </div>
    ";
    return $html;
});

Route::prefix('admin')->group(function () {
    Route::get('/admin/contacts', function () {
        return "<h1>All Contacts</h1>";
    })->name('contacts.index');

    Route::get('/admin/contacts/create', function () {
        return "<h1>Add new contact</h1>";
    })->name('contacts.create');

    Route::get('/admin/contacts/{id}', function ($id) {
        return "Contact" . $id;
    })->name('contacts.show');

    Route::fallback(function () {
        return "<h1>ページは存在していません！</h1>";
    });
});
