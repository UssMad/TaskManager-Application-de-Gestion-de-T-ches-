<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $taskCounts = [
        'total'       => \App\Models\Task::where('user_id', auth()->id())->count(),
        'todo'        => \App\Models\Task::where('user_id', auth()->id())->where('status', 'todo')->count(),
        'in_progress' => \App\Models\Task::where('user_id', auth()->id())->where('status', 'in_progress')->count(),
        'done'        => \App\Models\Task::where('user_id', auth()->id())->where('status', 'done')->count(),
        'overdue'     => \App\Models\Task::where('user_id', auth()->id())
                            ->where('status', '!=', 'done')
                            ->whereNotNull('due_date')
                            ->where('due_date', '<', now()->toDateString())
                            ->count(),
    ];
    return view('dashboard', compact('taskCounts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::patch('tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
});

require __DIR__.'/auth.php';
