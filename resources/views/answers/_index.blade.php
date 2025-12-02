

<div class="mt-6">
    <div class="w-full bg-white shadow rounded">
        <div class="p-6">
            <div class="mb-4">
                <h2 class="text-2xl font-semibold">
                     {{ $answersCount . " " . Str::plural('Answer', $answersCount) }}
                </h2>
            </div>

            <div class="border-b mb-4"></div>

            @include ('layouts._messages')

            @foreach ($answers as $answer)
                <div class="flex gap-4">
                    <!-- VOTE CONTROLS -->
                    <div class="flex flex-col items-center text-gray-600">
                        <a title="This answer is useful" class="cursor-pointer hover:text-green-600">
                            <i class="fas fa-caret-up text-4xl"></i>
                        </a>

                        <span class="text-lg font-semibold my-1">1230</span>

                        <a title="This answer is not useful" class="cursor-pointer text-gray-400 hover:text-red-600">
                            <i class="fas fa-caret-down text-4xl"></i>
                        </a>

                        @can('accept', $answer)
                            <a title="Mark this answer as best answer"
                                class="{{ $answer->status }} mt-3 cursor-pointer text-green-600"
                                onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();">
                                <i class="fas fa-check text-2xl"></i>
                            </a>

                            <form id="accept-answer-{{ $answer->id }}"
                                  action="{{ route('answers.accept', $answer->id) }}"
                                  method="POST" class="hidden">
                                @csrf
                            </form>
                        @else
                            @if ($answer->is_best)
                                <a title="The question owner accepted this answer as best answer"
                                   class="{{ $answer->status }} mt-3 text-green-600">
                                    <i class="fas fa-check text-2xl"></i>
                                </a>
                            @endif
                        @endcan
                    </div>

                    <!-- MAIN BODY -->
                    <div class="flex-1">
                        <div class="prose max-w-none">
                            {!! $answer->body_html !!}
                        </div>

                        <div class="grid grid-cols-3 gap-4 mt-4 items-start">
                            <div>
                                <div class="flex gap-2">
                                    @can('update', $answer)
                                        <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                                           class="px-3 py-1 text-sm border border-blue-500 text-blue-500 rounded hover:bg-blue-500 hover:text-white transition">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('delete', $answer)
                                        <form method="POST"
                                              action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}"
                                              class="inline"
                                              onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 text-sm border border-red-500 text-red-500 rounded hover:bg-red-500 hover:text-white transition">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>

                            <div></div>

                            <div class="text-right">
                                <span class="text-gray-500 text-sm">Answered {{ $answer->created_date }}</span>
                                <div class="flex justify-end items-center mt-2">
                                    <a href="{{ $answer->user->url }}" class="mr-2">
                                        <img src="{{ $answer->user->avatar }}" class="w-10 h-10 rounded-full">
                                    </a>
                                    <div>
                                        <a href="{{ $answer->user->url }}" class="font-medium text-gray-800 hover:underline">
                                            {{ $answer->user->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="border-b my-6"></div>
            @endforeach

        </div>
    </div>
</div>

