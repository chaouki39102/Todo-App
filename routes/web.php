<?php

use App\Http\Controllers\TaskController;
use App\Http\Livewire\Task;
use App\Http\Livewire\TaskComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {
Route::get('task',[ TaskController::class , 'index'])->name('task');
});

include ('auth.php');
