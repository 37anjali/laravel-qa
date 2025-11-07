@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white shadow-md rounded-2xl overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">All Questions</h2>
            <a href="{{ route('questions.create') }}"
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition duration-200">
                + Ask Question
            </a>
        </div>

        <div class="p-6 space-y-6">
            @forelse ($questions as $question)
                <div class="border border-gray-100 rounded-xl p-5 hover:shadow-md transition duration-200">
                    <div class="flex justify-between items-start">
                        <h3 class="text-xl font-semibold text-gray-800 hover:text-indigo-600 transition">
                            <a href="{{ route('questions.show', $question->id) }}">
                                {{ $question->title }}
                            </a>
                        </h3>
                        <span class="text-sm text-gray-500">
                            {{ $question->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <p class="mt-3 text-gray-600 leading-relaxed">
                        {{ \Illuminate\Support\Str::limit($question->body, 200) }}
                    </p>

                    <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                        <div class="flex items-center space-x-4">
                            <span><strong>{{ $question->votes }}</strong> votes</span>
                            <span><strong>{{ $question->answers }}</strong> answers</span>
                            <span><strong>{{ $question->views }}</strong> views</span>
                        </div>

                        <div>
                            <span class="text-gray-700 font-medium">Asked by:</span>
                            <span class="text-indigo-600 font-semibold">{{ $question->user->name ?? 'Anonymous' }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m2 8H7a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v8a2 2 0 01-2 2z" />
                    </svg>
                    <p class="mt-2 text-lg">No questions have been asked yet.</p>
                </div>
            @endforelse
        </div>

        <div class=" mx-auto px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $questions->links() }}
        </div>
    </div>
</div>
@endsection
