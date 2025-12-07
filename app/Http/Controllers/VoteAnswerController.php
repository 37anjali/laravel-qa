<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, Answer $answer)
    {
        $vote = (int) $request->input('vote');

        $request->user()->voteAnswer($answer, $vote);

        return back();
    }
}
