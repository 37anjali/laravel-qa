@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    <div class="bg-white shadow rounded-lg p-6">
        
        <!-- Title + Back Button -->
        <div class="flex items-center mb-6">
            <h1 class="text-3xl font-bold">{{ $question->title }}</h1>

            <div class="ml-auto">
                <a href="{{ route('questions.index') }}" 
                   class="px-4 py-2 border border-gray-400 text-gray-700 rounded-lg hover:bg-gray-100">
                    Back to all Questions
                </a>
            </div>
        </div>

        <hr class="my-4">

        <!-- MAIN CONTENT WRAPPER -->
        <div class="flex space-x-6">

            <!-- VOTE + FAVORITE SECTION -->
            <div class="flex flex-col items-center">

               <!-- Vote Up -->
<a title="This question is useful"
   class="vote-up {{ Auth::guest() ? 'opacity-50 pointer-events-none' : '' }} cursor-pointer text-gray-500 hover:text-green-600 transition"
   onclick="event.preventDefault(); document.getElementById('up-vote-question-{{ $question->id }}').submit();">
   
   <i class="fas fa-caret-up text-4xl"></i>
</a>

<form id="up-vote-question-{{ $question->id }}"
      method="POST"
      action="/questions/{{ $question->id }}/vote"
      class="hidden">
    @csrf
    <input type="hidden" name="vote" value="1">
</form>





                <!-- Vote Count -->
                <span class="text-xl font-semibold my-1">{{ $question->votes_count}}</span>
<!-- Vote Down -->
<a title="This question is not useful"
   class="vote-down {{ Auth::guest() ? 'opacity-50 pointer-events-none' : '' }} cursor-pointer text-gray-400 hover:text-red-600 transition"
   onclick="event.preventDefault(); document.getElementById('down-vote-question-{{ $question->id }}').submit();">

    <i class="fas fa-caret-down text-4xl"></i>
</a>

<form id="down-vote-question-{{ $question->id }}"
      method="POST"
      action="/questions/{{ $question->id }}/vote"
      class="hidden">
    @csrf
    <input type="hidden" name="vote" value="-1">
</form>


                <!-- Favorite -->
                <a title="Click to mark as favorite question (Click again to undo)"
                   class="mt-3 cursor-pointer flex flex-col items-center
                        {{ Auth::guest() ? 'opacity-50' : ($question->is_favorited ? 'text-yellow-500' : 'text-gray-400') }}"
                   onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit();">

                    <i class="fas fa-star fa-2x"></i>
                    <span class="text-sm">{{ $question->favorites_count }}</span>
                </a>

                <form id="favorite-question-{{ $question->id }}" 
                      method="POST"
                      action="/questions/{{ $question->id }}/favorites"
                      class="hidden">
                    @csrf
                    @if ($question->is_favorited)
                        @method('DELETE')
                    @endif
                </form>

            </div>

            <!-- QUESTION BODY -->
            <div class="flex-1">

                <div class="prose max-w-none">
                    {!! $question->body_html !!}
                </div>

               <!-- USER INFO -->
<div class="grid grid-cols-3 gap-4 items-center">
    
    <!-- Empty column -->
    <div></div>

    <!-- Empty column -->
    <div></div>

    <!-- Author include -->
    <div class="flex justify-end">
        @include('shared._author', [
            'model' => $question,
            'label' => 'asked'
        ])
    </div>

</div>

               </div>
            </div>

        </div>

    </div>

    <!-- Answers Section -->
    <div class="mt-8">
        @include ('answers._index', [
            'answers' => $question->answers,
            'answersCount' => $question->answers_count,
        ])
    </div>

    <!-- Create Answer -->
    <div class="mt-6">
        @include ('answers._create')
    </div>

</div>
@endsection
