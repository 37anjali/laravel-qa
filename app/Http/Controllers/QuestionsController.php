<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;






class QuestionsController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */

// public function __construct()
// {
//     $this->middleware('auth', ['except' => ['index', 'show']]);
// }


    public function index()
{
    DB::enableQueryLog(); // start logging

    $questions = Question::with('user')->latest()->paginate(10); 

  return  view('questions.index', compact('questions'))->render();

    // // dump the logged queries
    // dd(DB::getQueryLog());

    // (normally you would return the view, but dd() stops execution)
    // return view('questions.index', compact('questions'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $question = new Question();
        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AskQuestionRequest $request)
    {
        // dd('store');


        $request->user()->questions()->create($request->only('title', 'body'));

        return redirect()->route('questions.index');
        return redirect()->route('questions.index')->with('success', "your question has been submitted");
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        


        $question->increment('views');

        return view('questions.show', compact('question'));

    }

    /**
     * Show the form for editing the specified resource.
     */
  public function edit(Question $question)
{
    $this->authorize('update', $question);

    return view("questions.edit", compact('question'));
}





    /**
     * Update the specified resource in storage.
     */
    public function update(AskQuestionRequest $request, Question $question)
    {

         $this->authorize('update', $question);

         $question->update($request->only('title','body'));

         return redirect('/questions')->with('success',"Your question has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {

        $this->authorize('delete', $question);
        $question->delete();
        return redirect('/questions')->with('success', "your question has been deleted.");
    }
}
