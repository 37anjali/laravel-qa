@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800">All Questions</h2>
        </div>

        <div class="p-6 space-y-8">
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
                        <h3 class="text-xl font-semibold text-blue-600 hover:underline">
                            <a href="{{ $question->url }}">{{ $question->title }}</a>
                        </h3>

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
