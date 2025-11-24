@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">

    <div class="bg-white shadow rounded-lg border border-gray-200">
        
        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800">
                {{ $question->title }}
            </h1>

            <a href="{{ route('questions.index') }}"
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 
                      rounded-md hover:bg-gray-100 transition">
                Back to all Questions
            </a>
        </div>

        <!-- Body -->
        <div class="px-6 py-6 prose max-w-none">
            {!! $question->body_html !!}
        </div>
    </div>

    <!-- Answers Section -->
    <div class="mt-8 bg-white shadow rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">
                Answers ({{ $question->answers->count() }})
            </h2>
        </div>

        <div class="px-6 py-6 space-y-6">
            @forelse($question->answers as $answer)
                <div class="border border-gray-200 rounded-lg p-5 bg-gray-50">
                    
                    <!-- Answer Body -->
                    <div class="prose max-w-none">
                        {!! $answer->body_html !!}
                    </div>

                    <!-- Answer Footer -->
                    <div class="mt-4 flex items-center justify-between text-sm text-gray-600">
                        <span>
                            Answered by 
                            <strong class="text-gray-800">{{ $answer->user->name }}</strong>
                            on {{ $answer->created_at->format('d M Y') }}
                        </span>

                        <span class="px-3 py-1 bg-gray-200 rounded text-xs">
                            Votes: {{ $answer->votes_count }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">No answers yet. Be the first to answer!</p>
            @endforelse
        </div>
    </div>

</div>
@endsection
