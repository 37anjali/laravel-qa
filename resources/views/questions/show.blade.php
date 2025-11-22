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

</div>
@endsection
