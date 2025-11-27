<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class AnswersController extends Controller
{

    use AuthorizesRequests;
    /**
     * Store a newly created answer.
     */
    public function store(Request $request, Question $question)
    {
        $validated = $request->validate([
            'body' => 'required|string'
        ]);

        $question->answers()->create([
            'body'    => $validated['body'],
            'user_id' => Auth::id(),

        ]);

        return back()->with('success', 'Your answer has been submitted successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update',$answer);
        return view('answers.edit', compact('question', 'answer'));
    }

    /**
     * Update the answer.
     */
    public function update(Request $request, Question $question, Answer $answer)
    {

        $this->authorize('update', $answer);
        $validated = $request->validate([
            'body' => 'required|string'
        ]);

        $answer->update($validated);

        return redirect()
            ->route('questions.show', $question->slug)
            ->with('success', 'Answer updated successfully.');
    }

    /**
     * Delete an answer.
     */
    public function destroy(Question $question, Answer $answer)
    {
        $answer->delete();

        return back()->with('success', 'Answer deleted successfully.');
    }
}
