 <!-- ANSWERS SECTION -->
    <div class="mt-10 bg-white shadow-lg rounded-xl border border-gray-200 p-8">

        <h2 class="text-xl font-bold text-gray-900 mb-4">
            {{ $question->answers_count }} 
            {{ \Illuminate\Support\Str::plural('Answer', $question->answers_count) }}
        </h2>
        <hr>
        @include('layouts._messages')

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