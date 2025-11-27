<!-- ANSWERS SECTION -->
<div class="mt-10 bg-white shadow-lg rounded-xl border border-gray-200 p-8">

    <h2 class="text-xl font-bold text-gray-900 mb-4">
        {{ $question->answers_count }} 
        {{ \Illuminate\Support\Str::plural('Answer', $question->answers_count) }}
    </h2>

    <hr class="mb-6">
    @include('layouts._messages')

    <div class="divide-y divide-gray-200">

        @foreach ($question->answers as $answer)
        <div class="py-8 flex flex-col md:flex-row gap-8">

            <!-- VOTE CONTROLS -->
            <div class="flex flex-col items-center gap-3 bg-gray-50 px-4 py-3 rounded-xl shadow border border-gray-200">

                <!-- Upvote -->
                <button class="text-gray-400 hover:text-green-600 transition text-3xl">
                    <i class="fas fa-caret-up"></i>
                </button>

                <!-- Vote Count -->
                <span class="text-2xl font-bold text-gray-800">
                    {{ $answer->votes_count ?? 1230 }}
                </span>

                <!-- Downvote -->
                <button class="text-gray-400 hover:text-red-600 transition text-3xl">
                    <i class="fas fa-caret-down"></i>
                </button>

                <!-- Best Answer -->
                <button class="{{ $answer->status }} text-green-600 hover:text-green-700 transition text-2xl mt-2">
                    <i class="fas fa-check"></i>
                </button>

            </div>

            <!-- ANSWER CONTENT -->
            <div class="flex-1">

                <!-- Body -->
                <div class="prose max-w-none text-gray-800">
                    {!! $answer->body_html !!}
                </div>

                <!-- ACTION BUTTONS + USER INFO -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3">

                        @if (Auth::user() && Auth::user()->can('update', $answer))
                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                               class="px-4 py-2 text-sm border border-blue-500 text-blue-600 rounded-lg hover:bg-blue-500 hover:text-white transition shadow-sm">
                                Edit
                            </a>
                        @endif

                        @if (Auth::user() && Auth::user()->can('delete', $answer))
                            <form method="POST" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 text-sm border border-red-500 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition shadow-sm"
                                    onclick="return confirm('Are you sure you want to delete this answer?')">
                                    Delete
                                </button>
                            </form>
                        @endif

                    </div>

                    <!-- User Info -->
                    <div class="flex justify-end">
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

        </div>
        @endforeach

    </div>

</div>
