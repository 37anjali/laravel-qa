@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="flex justify-center">
        <div class="w-full">
            <div class="bg-white shadow rounded-lg">
                
                {{-- Card Header --}}
                <div class="px-6 py-4 border-b flex items-center">
                    <h2 class="text-2xl font-semibold">Edit Question</h2>
                    
                    <div class="ml-auto">
                        <a href="{{ route('questions.index') }}"
                           class="px-4 py-2 text-sm border border-gray-500 text-gray-700 rounded hover:bg-gray-700 hover:text-white transition">
                            Back to all Questions
                        </a>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="px-6 py-6">
                    <form action="{{ route('questions.update', $question->id) }}" method="post" class="space-y-4">
                        @method('PUT')
                        @csrf

                        @include("questions._form", ['buttonText' => "Update Question"])
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
