<a title="Click to mark as favorite question (Click again to undo)" 
    class="flex items-center gap-2 cursor-pointer mt-2 
        {{ Auth::guest() ? 'opacity-50 cursor-not-allowed' : ($model->is_favorited ? 'text-yellow-500' : 'text-gray-400') }} 
        hover:text-yellow-500 transition"
    onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit();">

    <!-- STAR ICON -->
    <i class="fas fa-star text-3xl"></i>

    <!-- COUNT -->
    <span class="text-sm font-semibold">{{ $model->favorites_count }}</span>
</a>

<form id="favorite-question-{{ $model->id }}" 
      action="/questions/{{ $model->id }}/favorites" 
      method="POST" 
      class="hidden">
    @csrf
    @if ($model->is_favorited)
        @method('DELETE')
    @endif
</form>
