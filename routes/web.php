<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ConversationController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/chat', function () {
    return Inertia::render('Chat/Container');
})->name('chat');


Route::middleware('auth:sanctum')->get('/chat/topics', [ConversationController::class, 'topics']);
Route::middleware('auth:sanctum')->get('/chat/topic/{topicId}/messages', [ConversationController::class, 'messages']);
Route::middleware('auth:sanctum')->post('/chat/topic/{topicId}/message', [ConversationController::class, 'newMessage']);