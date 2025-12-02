<?php

use App\Http\Controllers\AcceptAnswerController;
use App\Http\Controllers\AnswersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('questions', QuestionsController::class)->except('show');
   Route::get('/questions/{question:slug}', [QuestionsController::class, 'show'])
    ->name('questions.show');

 Route::resource('questions.answers', AnswersController::class)
    ->only(['store', 'edit', 'update', 'destroy']);

  

Route::post('/answers/{answer}/accept', [AcceptAnswerController ::class, 'accept'])->name('answers.accept');




});

require __DIR__.'/auth.php';


// Route::get('/home', [HomeController::class, 'index'])->name('home');
