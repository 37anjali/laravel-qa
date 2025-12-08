@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

    <div class="bg-white shadow rounded-lg p-6">
        
        <!-- Title + Back Button -->
        <div class="flex items-center">
            <h1 class="text-3xl font-bold">{{ $question->title }}</h1>

            <div class="ml-auto">
                <a href="{{ route('questions.index') }}" 
                   class="px-4 py-2 border border-gray-400 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                    Back to all Questions
                </a>
            </div>
        </div>

        <hr class="my-4">

        <!-- Vote + Question Body -->
        <div class="flex gap-6">
            
            <!-- Votes -->
            @include('shared._vote', [
                'model' => $question
            ])

            <!-- Question Body -->
            <div class="flex-1">
                {!! $question->body_html !!}

                <!-- User Info -->
                <div class="grid grid-cols-3 mt-6">
                    <div></div>
                    <div></div>
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

    <!-- Answers List -->
    <div class="mt-10">
        @include('answers._index', [
            'answers' => $question->answers,
            'answersCount' => $question->answers_count,
        ])
    </div>

    <!-- Create Answer -->
    <div class="mt-6">
        @include('answers._create')
    </div>

</div>
@endsection
