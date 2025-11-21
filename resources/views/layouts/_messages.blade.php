@if (session('success'))
    <div class="mb-4 flex items-center justify-between rounded-lg bg-green-100 px-4 py-3 text-green-700 shadow">
        <div>
            <strong class="font-semibold">Success!</strong> {{ session('success') }}
        </div>
        <button 
            type="button" 
            onclick="this.parentElement.remove()" 
            class="text-green-700 hover:text-green-900"
        >
            &times;
        </button>
    </div>
@endif
