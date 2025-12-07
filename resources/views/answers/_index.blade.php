<div class="mt-6">
    <div class="bg-white shadow-md rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-semibold mb-4">
                {{ $answersCount . " " . \Illuminate\Support\Str::plural('Answer', $answersCount) }}
            </h2>

            @include ('layouts._messages')

            @foreach ($answers as $answer)
                <div class="flex gap-6 py-6">
                    
                    <!-- Voting Controls -->
                    <div class="flex flex-col items-center text-gray-500">
                        <!-- Up Vote -->
                        <a title="This answer is useful"
                            class="cursor-pointer {{ Auth::guest() ? 'opacity-40 pointer-events-none' : '' }}"
                            onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();">
                            <i class="fas fa-caret-up text-4xl"></i>
                        </a>

                        <form id="up-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote"
                              method="POST" class="hidden">
                            @csrf
                            <input type="hidden" name="vote" value="1">
                        </form>

                        <span class="text-lg font-semibold my-1">{{ $answer->votes_count }}</span>

                        <!-- Down Vote -->
                        <a title="This answer is not useful"
                            class="cursor-pointer {{ Auth::guest() ? 'opacity-40 pointer-events-none' : '' }}"
                            onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit();">
                            <i class="fas fa-caret-down text-4xl"></i>
                        </a>

                        <form id="down-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote"
                              method="POST" class="hidden">
                            @csrf
                            <input type="hidden" name="vote" value="-1">
                        </form>

                        <!-- Accept Answer -->
                        @can ('accept', $answer)
                            <a title="Mark this answer as best answer"
                               class="cursor-pointer mt-3 {{ $answer->status }}"
                               onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();">
                                <i class="fas fa-check text-3xl text-green-500"></i>
                            </a>

                            <form id="accept-answer-{{ $answer->id }}" action="{{ route('answers.accept', $answer->id) }}"
                                  method="POST" class="hidden">
                                @csrf
                            </form>
                        @else
                            @if ($answer->is_best)
                                <div class="mt-3 {{ $answer->status }}">
                                    <i class="fas fa-check text-3xl text-green-500"></i>
                                </div>
                            @endif
                        @endcan
                    </div>

                    <!-- Answer Body -->
                    <div class="flex-1">
                        <div class="prose max-w-none">
                            {!! $answer->body_html !!}
                        </div>

                        <div class="grid grid-cols-3 gap-4 mt-4">
                            
                            <!-- Edit/Delete Buttons -->
                            <div>
                                @can ('update', $answer)
                                    <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                                       class="text-blue-600 border border-blue-500 px-3 py-1 text-sm rounded hover:bg-blue-50">
                                        Edit
                                    </a>
                                @endcan

                                @can ('delete', $answer)
                                    <form method="POST"
                                          action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}"
                                          class="inline-block"
                                          onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 border border-red-500 px-3 py-1 text-sm rounded hover:bg-red-50">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                            </div>

                            <div></div>

                            <!-- User Info -->
                            <div class="text-right">
                                <span class="text-gray-500 text-sm">Answered {{ $answer->created_date }}</span>
                                <div class="flex items-center justify-end mt-2 gap-2">
                                    <img src="{{ $answer->user->avatar }}" class="w-10 h-10 rounded-full">
                                    <a href="{{ $answer->user->url }}" class="text-blue-600 font-medium">
                                        {{ $answer->user->name }}
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <hr class="my-4 border-gray-300">
            @endforeach
        </div>
    </div>
</div>
