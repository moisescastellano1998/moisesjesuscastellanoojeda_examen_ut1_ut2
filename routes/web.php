<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MessageController;

Route::get('/', [FormController::class, 'loadForm'])->name('load.form');

Route::get('/messages', function () {
    $messages = \App\Models\Message::all();
    return view('messages', ['messages' => $messages]);
})->name('load.messages');

Route::post('/manageData', [FormController::class, 'manageData'])->name('manage.data');

Route::get('/editForm/{id}', [MessageController::class, 'editForm'])->name('edit.form');

Route::put('/editData/{id}', [FormController::class, 'editMessage'])->name('edit.data');