<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Survey') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('admin.surveys.update', $survey) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="question" class="block text-sm font-medium text-gray-700">Survey Question</label>
                        <input type="text" name="question" id="question" value="{{ old('question', $survey->question) }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm" required>
                        @error('question')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Answer Options (Note: Updating options is limited in this version to prevent data corruption)</label>
                        @foreach($survey->options as $index => $option)
                            <div class="option-item flex gap-2">
                                <input type="text" name="options[]" value="{{ $option->option_text }}" class="flex-1 rounded-lg border-gray-100 bg-gray-50 text-gray-500 cursor-not-allowed" readonly>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex justify-end gap-4">
                        <a href="{{ route('admin.surveys.index') }}" class="bg-white border border-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
                        <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-700 shadow-sm transition-all transform hover:scale-105 active:scale-95">Update Survey</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
