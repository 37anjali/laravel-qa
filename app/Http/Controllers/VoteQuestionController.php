<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request (Single-action Controller)
     */
    public function __invoke(Request $request, Question $question)
    {
        $validated = $request->validate([
            'vote' => 'required|in:-1,1',
        ]);

        $vote = (int) $validated['vote'];

        $request->user()->voteQuestion($question, $vote);

        return back()->with('success', 'Vote submitted successfully.');
    }
}
