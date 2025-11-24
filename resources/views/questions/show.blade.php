@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">

    <!-- Question Box -->
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

        <!-- Answer Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ $question->answers_count }}
                {{ \Illuminate\Support\Str::plural('Answer', $question->answers_count) }}
            </h2>
        </div>

       <!-- Answers Section -->
<div class="mt-8 bg-white shadow rounded-lg border border-gray-200">

    <!-- Answer Header -->
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ $question->answers_count }}
            {{ \Illuminate\Support\Str::plural('Answer', $question->answers_count) }}
        </h2>
    </div>

    <!-- Answers -->
    <div class="divide-y divide-gray-200">

        @foreach($question->answers as $answer)
        <div class="p-6">

            <!-- Answer Body -->
            <div class="prose prose-sm max-w-none text-gray-800">
                {!! $answer->body_html !!}
            </div>

            <!-- Footer - username + avatar + votes bottom-right -->
            <div class="mt-6 flex items-center justify-between">

                <!-- Left Side: Empty / Optional buttons area -->
                <div></div>

                <!-- Right Side: Avatar + name + view profile + votes -->
                <div class="flex items-center space-x-4">

                    <!-- Votes -->
                    <span class="px-3 py-1 bg-gray-100 rounded text-xs text-gray-700">
                        Votes: {{ $answer->votes_count }}
                    </span>

                    <!-- View Profile -->
                    <a href="{{ $answer->user->url }}"
                       class="text-blue-600 text-sm hover:underline">
                        View Profile
                    </a>

                    <!-- Username -->
                    <div class="text-right">
                        <p class="font-semibold text-gray-800">{{ $answer->user->name }}</p>
                        <p class="text-xs text-gray-500">
                            {{ $answer->created_at->diffForHumans() }}
                        </p>
                    </div>

                    <!-- Avatar -->
                    <img 
                        src="{{ $answer->user->avatar }}" 
                        alt="{{ $answer->user->name }}"
                        class="w-10 h-10 rounded-full shadow border object-cover"
                    >
                </div>

            </div>

        </div>
        @endforeach

        @if($question->answers_count == 0)
            <p class="p-6 text-gray-600">No answers yet. Be the first to answer!</p>
        @endif

    </div>

</div>


</div>
@endsection
