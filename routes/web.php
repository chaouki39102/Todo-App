<?php

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

// Route::get('/', function () {
//     return redirect('/task');
// });
// Route::get('files', [GetFileController::class,'index'])->name('get-file');


// Route::middleware('auth')->resource('task',TaskController::class );

Route::middleware('auth')->get('task',Task::class)->name('task');
include ('auth.php');

// Route::get('students', StudentsComponent::class);
