<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use App\Models\Category;
use App\Models\Task;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'categories' => Category::all(),
        'tasks' => Task::where('user_id', auth()->id())->get(),
    ]);
})->middleware(['auth'])->name('dashboard');



Route::get('/', [TaskController::class, 'index'])
    ->name('tasks.index');

Route::post('/categories', [CategoryController::class, 'store'])
    ->name('categories.store')->middleware('auth');

Route::post('/tasks', [TaskController::class, 'store'])
    ->name('tasks.store');

Route::patch('/tasks/{id}', [TaskController::class, 'toggle'])
    ->name('tasks.toggle');

require __DIR__ . '/auth.php';
