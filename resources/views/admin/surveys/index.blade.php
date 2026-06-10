<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Surveys') }}
            </h2>
            <a href="{{ route('admin.surveys.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition-colors">Create New Survey</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="py-4 px-2 font-bold text-gray-700">Question</th>
                                <th class="py-4 px-2 font-bold text-gray-700 w-24">Options</th>
                                <th class="py-4 px-2 font-bold text-gray-700 w-24">Status</th>
                                <th class="py-4 px-2 font-bold text-gray-700 w-48 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($surveys as $survey)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-2 text-gray-800 font-medium">{{ $survey->question }}</td>
                                    <td class="py-4 px-2 text-gray-500">{{ $survey->options_count }}</td>
                                    <td class="py-4 px-2">
                                        @if($survey->is_active)
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full font-bold">ACTIVE</span>
                                        @else
                                            <span class="px-2 py-1 bg-gray-100 text-gray-500 text-xs rounded-full font-bold">INACTIVE</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-2 text-right">
                                        <div class="flex justify-end gap-3">
                                            <form action="{{ route('admin.surveys.toggle-active', $survey) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-sm font-bold {{ $survey->is_active ? 'text-orange-600 hover:text-orange-800' : 'text-green-600 hover:text-green-800' }}">
                                                    {{ $survey->is_active ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.surveys.edit', $survey) }}" class="text-blue-600 hover:text-blue-800 text-sm font-bold">Edit</a>
                                            <form action="{{ route('admin.surveys.destroy', $survey) }}" method="POST" onsubmit="return confirm('Are you sure? This will delete all votes for this survey.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-bold">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center text-gray-400 italic">No surveys found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $surveys->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
