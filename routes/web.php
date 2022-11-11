<?php

use App\Http\Controllers\EventController;
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

Route::post('/api/instagram/hashtag', [EventController::class, 'getHashtag']);
Route::post('/api/instagram/event', [EventController::class, 'postEvent']);
Route::get('/api/instagram/event', [EventController::class, 'getEvent']);
Route::get('/api/instagram/event/{id}', [EventController::class, 'getEventById']);
Route::get('/api/instagram/event/delete/{id}', [EventController::class, 'deleteEvent']);
