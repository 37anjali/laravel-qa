@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">

    <!-- QUESTION CARD -->
    <div class="bg-white shadow-lg rounded-xl border border-gray-200 p-8">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-900">
                {{ $question->title }}
            </h1>

            <a href="{{ route('questions.index') }}"
               class="px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white hover:bg-gray-100 shadow-sm transition">
                ← Back to all Questions
            </a>
        </div>

        <!-- QUESTION BLOCK -->
        <div class="flex gap-8">

            <!-- VOTE CONTROLS (Horizontal & Beautiful) -->
            <div class="flex flex-col items-center gap-3 bg-gray-50 px-4 py-3 rounded-xl shadow border border-gray-200">

                <!-- Upvote -->
                <button class="text-gray-400 hover:text-green-600 transition text-3xl">
                    <i class="fas fa-caret-up"></i>
                </button>

                <!-- Vote count -->
                <span class="text-2xl font-bold text-gray-800">
                    {{ $question->votes_count ?? 1230 }}
                </span>

                <!-- Downvote -->
                <button class="text-gray-400 hover:text-red-600 transition text-3xl">
                    <i class="fas fa-caret-down"></i>
                </button>

                <!-- Favorite -->
                <button class="text-yellow-500 hover:text-yellow-600 transition text-2xl mt-2 flex flex-col items-center">
                    <i class="fas fa-star"></i>
                    <span class="text-xs font-semibold">{{ $question->favorites_count ?? 123 }}</span>
                </button>

            </div>

            <!-- QUESTION CONTENT -->
            <div class="flex-1">

                <div class="prose max-w-none text-gray-800">
                    {!! $question->body_html !!}
                </div>

                <!-- USER INFO -->
                <div class="mt-6 flex justify-end">
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 shadow-sm flex items-center gap-3">

                        <img src="{{ $question->user->avatar }}" 
                             class="w-12 h-12 rounded-full border shadow object-cover">

                        <div>
                            <p class="text-gray-900 font-semibold">
                                <a href="{{ $question->user->url }}" class="hover:underline">
                                    {{ $question->user->name }}
                                </a>
                            </p>
                            <p class="text-xs text-gray-500">
                                Asked {{ $question->created_date }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- ANSWERS SECTION -->
    <div class="mt-10 bg-white shadow-lg rounded-xl border border-gray-200 p-8">

        <h2 class="text-xl font-bold text-gray-900 mb-4">
            {{ $question->answers_count }} 
            {{ \Illuminate\Support\Str::plural('Answer', $question->answers_count) }}
        </h2>

        <div class="divide-y divide-gray-200">

            @foreach ($question->answers as $answer)
            <div class="py-6 flex gap-8">

                <!-- VOTE CONTROLS -->
                <div class="flex flex-col items-center gap-3 bg-gray-50 px-4 py-3 rounded-xl shadow border border-gray-200">

                    <!-- Upvote -->
                    <button class="text-gray-400 hover:text-green-600 transition text-3xl">
                        <i class="fas fa-caret-up"></i>
                    </button>

                    <!-- Count -->
                    <span class="text-2xl font-bold text-gray-800">
                        {{ $answer->votes_count ?? 1230 }}
                    </span>

                    <!-- Downvote -->
                    <button class="text-gray-400 hover:text-red-600 transition text-3xl">
                        <i class="fas fa-caret-down"></i>
                    </button>

                    <!-- Best Answer -->
                    <button class="text-green-600 hover:text-green-700 transition text-2xl mt-2">
                        <i class="fas fa-check"></i>
                    </button>

                </div>

                <!-- ANSWER BODY -->
                <div class="flex-1">

                    <div class="prose max-w-none text-gray-800">
                        {!! $answer->body_html !!}
                    </div>

                    <!-- USER INFO -->
                    <div class="mt-6 flex justify-end">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 shadow-sm flex items-center gap-3">

                            <img src="{{ $answer->user->avatar }}" 
                                 class="w-12 h-12 rounded-full border shadow object-cover">

                            <div>
                                <p class="text-gray-900 font-semibold">
                                    <a href="{{ $answer->user->url }}" class="hover:underline">
                                        {{ $answer->user->name }}
                                    </a>
                                </p>
                                <p class="text-xs text-gray-500">
                                    Answered {{ $answer->created_date }}
                                </p>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
            @endforeach

        </div>

    </div>

</div>
@endsection
