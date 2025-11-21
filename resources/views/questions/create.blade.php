@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-800">Ask Question</h2>
            <a href="{{ route('questions.index') }}" 
               class="px-4 py-2 border border-gray-400 text-gray-700 rounded hover:bg-gray-100 transition">
               Back to all Questions
            </a>
        </div>

        <!-- Form Body -->
        <div class="px-6 py-6">
            <form action="{{ route('questions.store') }}" method="post" class="space-y-6">
                @csrf

                <!-- Question Title -->
                <div>
                    <label for="question-title" class="block text-gray-700 font-medium mb-2">Question Title</label>
                    <input type="text" name="title"  value="{{old('title')}}" id="question-title" 
                           class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                                  {{ $errors->has('title') ? 'border-red-500' : 'border-gray-300' }}">

                    @if ($errors->has('title'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('title') }}</p>
                    @endif
                </div>

                <!-- Question Body -->
                <div>
                    <label for="question-body" class="block text-gray-700 font-medium mb-2">Explain your question</label>
                    <textarea name="body" id="question-body" rows="8"
                              class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                                     {{ $errors->has('body') ? 'border-red-500' : 'border-gray-300' }}">{{ old('body') }}</textarea>

                    @if ($errors->has('body'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('body') }}</p>
                    @endif
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                        Ask this question
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
