<?php

namespace App\Http\Controllers;
use App\Models\Answer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use Illuminate\Http\Request;

class AcceptAnswerController extends Controller
{
    use AuthorizesRequests;

    public function accept(Answer $answer)
    {
        
       $this->authorize('accept', $answer);
       $answer->question->acceptBestAnswer($answer);
       return back();

    }

    
}
