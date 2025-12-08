@can('accept', $model)
    <a title="Mark this answer as best answer"
        class="cursor-pointer mt-2 
            {{ $model->status === 'accepted' ? 'text-green-600' : 'text-gray-400' }}
            hover:text-green-600 transition"
        onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit();">

        <i class="fas fa-check text-3xl"></i>
    </a>

    <form id="accept-answer-{{ $model->id }}" 
          action="{{ route('answers.accept', $model->id) }}" 
          method="POST" 
          class="hidden">
        @csrf
    </form>

@else
    @if ($model->is_best)
        <a title="The question owner accepted this answer as best answer"
            class="mt-2 text-green-600 cursor-default">
            
            <i class="fas fa-check text-3xl"></i>
        </a>
    @endif
@endcan
