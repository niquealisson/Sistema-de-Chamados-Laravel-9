<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;   
use App\Models\Event;
use App\Models\User; 



Route::get('/',[EventController::class, 'index']);
Route::get('/events/create',[EventController::class, 'create'])->middleware('auth');
Route::get('/events/{id}',[EventController::class, 'show'])->middleware('auth');
Route::POST('/events',[EventController::class, 'store'])->middleware('auth');
Route::delete('/events/{id}',[EventController::class, 'destroy'])->middleware('auth');
Route::get('/events/edit/{id}',[EventController::class, 'edit'])->middleware('auth');
Route::put('/events/update/{id}',[EventController::class, 'update'])->middleware('auth');


Route::get('/contact', function () {
    return view('contact');
});
Route::get('/dashboard',[EventController::class, 'dashboard'])->middleware('auth');

Route::POST('/events/join/{id}',[EventController::class, 'joinSolicitacao'])->middleware('auth');

Route::delete('/events/leave/{id}',[EventController::class, 'leaveSolicitacao'])->middleware('auth');

require __DIR__.'/auth.php';

