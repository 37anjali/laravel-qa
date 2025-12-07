<?php

use App\Http\Controllers\AcceptAnswerController;
use App\Http\Controllers\AnswersController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoteAnswerController;
use App\Http\Controllers\VoteQuestionController;
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
 Route::post('/questions/{question}/favorites', [FavoritesController::class,'store'])->name('questions.favorite');
Route::delete('/questions/{question}/favorites', [FavoritesController::class,'destroy'])->name('questions.unfavorite');
Route::post('/questions/{question}/vote', VoteQuestionController::class)
    ->name('questions.vote');

  Route::post('answers/{answer}/vote', VoteAnswerController::class)->name('answers.vote');  






});

require __DIR__.'/auth.php';


// Route::get('/home', [HomeController::class, 'index'])->name('home');
