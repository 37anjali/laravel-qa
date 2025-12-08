@if ($model instanceof \App\Models\Question)
    @php
        $name = 'question';
        $firstURISegment = 'questions';
    @endphp
@elseif ($model instanceof \App\Models\Answer)
    @php
        $name = 'answer';
        $firstURISegment = 'answers';
    @endphp
@endif

@php
    $formId = $name . "-" . $model->id;
    $formAction = "/{$firstURISegment}/{$model->id}/vote";
@endphp

<!-- Tailwind Vote Controls -->
<div class="flex flex-col items-center space-y-2 text-gray-700">

    <!-- UPVOTE -->
    <a title="This {{ $name }} is useful"
       class="cursor-pointer {{ Auth::guest() ? 'opacity-40 pointer-events-none' : 'hover:text-green-600' }}"
       onclick="event.preventDefault(); document.getElementById('up-vote-{{ $formId }}').submit();">

        <i class="fas fa-caret-up text-4xl"></i>
    </a>

    <form id="up-vote-{{ $formId }}" 
          action="{{ $formAction }}" 
          method="POST" 
          class="hidden">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>

    <!-- Vote Count -->
    <span class="text-xl font-semibold">{{ $model->votes_count }}</span>

    <!-- DOWNVOTE -->
    <a title="This {{ $name }} is not useful"
       class="cursor-pointer {{ Auth::guest() ? 'opacity-40 pointer-events-none' : 'hover:text-red-600' }}"
       onclick="event.preventDefault(); document.getElementById('down-vote-{{ $formId }}').submit();">

        <i class="fas fa-caret-down text-4xl"></i>
    </a>

    <form id="down-vote-{{ $formId }}" 
          action="{{ $formAction }}" 
          method="POST" 
          class="hidden">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>

    <!-- Favorite / Accept -->
    @if ($model instanceof \App\Models\Question)
        @include('shared._favorite', ['model' => $model])
    
    @elseif ($model instanceof \App\Models\Answer)
        @include('shared._accept', ['model' => $model])
    @endif

</div>
