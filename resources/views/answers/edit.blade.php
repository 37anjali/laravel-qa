@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                
                <h1 class="text-2xl font-semibold text-gray-800 mb-4">
                    Editing answer for question: 
                    <span class="font-bold text-indigo-600">{{ $question->title }}</span>
                </h1>

                <hr class="my-4">

                <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <textarea 
                            name="body" 
                            rows="7" 
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none 
                            @error('body') border-red-500 @enderror"
                        >{{ old('body', $answer->body) }}</textarea>

                        @error('body')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button 
                            type="submit" 
                            class="px-6 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition"
                        >
                            Update Answer
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
