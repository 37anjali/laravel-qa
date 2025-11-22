@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-red-800 align items-center">All Questions</h2>
          <div class="ml-auto">
    <a href="{{ route('questions.create') }}" 
       class="px-4 py-2 border border-gray-400 text-red-700 rounded hover:bg-gray-100 transition">
        Ask Question
    </a>
</div>

        </div>

        <div class="p-6 space-y-8">
            @include('layouts._messages')
            @foreach ($questions as $question)
                <div class="flex items-start border-b border-gray-100 pb-6">
                    <!-- Counters -->
                    <div class="flex flex-col text-center mr-6 text-sm font-medium text-gray-600">
                        <!-- Votes -->
                        <div class="mb-2">
                            <span class="block text-lg font-semibold text-gray-800">{{ $question->votes }}</span>
                            <span>{{ Str::plural('vote', $question->votes) }}</span>
                        </div>

                        <!-- Answers -->
                        <div class="mb-2  status {{ $question->status }}">
                            <div class="{{ $question->answers > 0 ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-800' }} rounded-md px-3 py-1">
                                <span class="block text-lg font-semibold">
                                    {{ $question->answers }}
                                </span>
                                <span>{{ Str::plural('answer', $question->answers) }}</span>
                            </div>
                        </div>

                        <!-- Views -->
                        <div>
                            <span class="block text-lg font-semibold text-gray-800">{{ $question->views }}</span>
                            <span>{{ Str::plural('view', $question->views) }}</span>
                        </div>
                    </div>

                    <!-- Question Content -->
                    <div class="flex-1">
                       <div class="flex items-center">
                      <h3 class="text-xl font-semibold text-blue-600 hover:underline">
                    <a href="{{ $question->url }}">{{ $question->title }}</a>
                   </h3>

                   <div class="ml-auto">
                  <a href="{{ route('questions.edit', $question->id) }}" class="px-3 py-1 text-sm border border-blue-500 text-blue-500 rounded hover:bg-blue-500 hover:text-white transition">
                     Edit
                      </a>

                     <form class="inline-block" method="POST" action="{{ route('questions.destroy', $question->id) }}">
    @method('DELETE')
    @csrf

    <button type="submit"
        class="px-3 py-1 text-sm border border-red-500 text-red-600 rounded hover:bg-red-600 hover:text-white transition"
        onclick="return confirm('Are you sure?')">
        Delete
    </button>
</form>

                    </div>



                    </div>

                        <p class="text-sm text-gray-500 mt-1">
                            Asked by 
                            <a href="{{ $question->user->url }}" class="text-gray-800 font-medium hover:underline">
                                {{ $question->user->name }}
                            </a> 
                            <span class="text-gray-400">· {{ $question->created_at->diffForHumans() }}</span>
                        </p>

                        <p class="mt-3 text-gray-700 leading-relaxed">
                            {{ Str::limit($question->body, 250) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="px-6 py-4 border-t border-gray-100">
            <div class="flex justify-center">
                {{ $questions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
