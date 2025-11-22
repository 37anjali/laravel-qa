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
              @include("questions._form", ['buttonText' => "Ask Question"])

            </form>
        </div>
    </div>
</div>
@endsection
