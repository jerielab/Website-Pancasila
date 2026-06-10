<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Survey') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('admin.surveys.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="question" class="block text-sm font-medium text-gray-700">Survey Question</label>
                        <input type="text" name="question" id="question" value="{{ old('question') }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm" required>
                        @error('question')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="options-container" class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Answer Options (Min 2)</label>
                        <div class="option-item flex gap-2">
                            <input type="text" name="options[]" class="flex-1 rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm" placeholder="Option 1" required>
                        </div>
                        <div class="option-item flex gap-2">
                            <input type="text" name="options[]" class="flex-1 rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm" placeholder="Option 2" required>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                        <button type="button" onclick="addOption()" class="text-sm font-bold text-blue-600 hover:text-blue-800">+ Add Another Option</button>
                        
                        <div class="flex gap-4">
                            <a href="{{ route('admin.surveys.index') }}" class="bg-white border border-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
                            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-700 shadow-sm transition-all transform hover:scale-105 active:scale-95">Create Survey</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addOption() {
            const container = document.getElementById('options-container');
            const count = container.querySelectorAll('.option-item').length + 1;
            const div = document.createElement('div');
            div.className = 'option-item flex gap-2';
            div.innerHTML = `
                <input type="text" name="options[]" class="flex-1 rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm" placeholder="Option ${count}" required>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 font-bold px-2">&times;</button>
            `;
            container.appendChild(div);
        }
    </script>
</x-app-layout>
