<div class="mt-10">
    <div class="bg-white shadow-lg rounded-xl border border-gray-200">
        <div class="p-6">
            
            <!-- Title -->
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Your Answer</h3>
            <hr class="mb-6">

            <form action="{{ route('questions.answers.store', $question->id) }}" method="POST">

                @csrf

                <!-- Textarea -->
                <div class="mb-5">
                    <textarea 
                        name="body"
                        rows="7"
                        class="w-full p-4 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                        @error('body') border-red-500 @enderror"
                        placeholder="Write your answer here..."
                    ></textarea>

                    @error('body')
                        <p class="text-red-600 text-sm mt-1">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="px-6 py-3 text-white bg-blue-600 hover:bg-blue-700 rounded-lg text-lg font-medium shadow-md transition"
                >
                    Submit
                </button>
            </form>

        </div>
    </div>
</div>
