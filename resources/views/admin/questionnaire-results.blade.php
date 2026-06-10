<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questionnaire Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Summary Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <h3 class="font-semibold text-gray-700 mb-2">Total Submissions</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalSubmissions }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <h3 class="font-semibold text-gray-700 mb-2">Average Sila Scores</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>Sila 1: {{ number_format($averageSila1, 1) }} / 15</li>
                        <li>Sila 2: {{ number_format($averageSila2, 1) }} / 15</li>
                        <li>Sila 3: {{ number_format($averageSila3, 1) }} / 15</li>
                        <li>Sila 4: {{ number_format($averageSila4, 1) }} / 15</li>
                        <li>Sila 5: {{ number_format($averageSila5, 1) }} / 15</li>
                    </ul>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <h3 class="font-semibold text-gray-700 mb-2">Category Percentages</h3>
                    <div class="grid grid-cols-1 gap-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <div class="text-sm">
                                <strong class="text-gray-700">Sila {{ $i }}:</strong>
                                <span class="text-green-600 font-semibold">Tinggi: {{ number_format($categoryPercentages[$i]['Tinggi'], 1) }}%</span>
                                <span class="text-yellow-600 font-semibold ml-2">Cukup: {{ number_format($categoryPercentages[$i]['Cukup'], 1) }}%</span>
                                <span class="text-red-600 font-semibold ml-2">Rendah: {{ number_format($categoryPercentages[$i]['Rendah'], 1) }}%</span>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Search & Filters -->
            <div class="bg-white p-6 rounded-lg shadow-sm border mb-6">
                <form id="filterForm" method="GET" action="{{ route('admin.results') }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <div>
                                <label for="sila{{ $i }}_category" class="block text-sm font-medium text-gray-700 mb-1">
                                    Sila {{ $i }} Category
                                </label>
                                <select name="sila{{ $i }}_category" id="sila{{ $i }}_category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                    <option value="">All</option>
                                    <option value="Tinggi" {{ request("sila{$i}_category") == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                    <option value="Cukup" {{ request("sila{$i}_category") == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                                    <option value="Rendah" {{ request("sila{$i}_category") == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                </select>
                            </div>
                        @endfor
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-semibold transition">
                            Apply Filters
                        </button>
                        <a href="{{ route('admin.results') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-semibold transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Results Table -->
            <div class="bg-white shadow-sm rounded-lg overflow-hidden border">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-4 border-b font-semibold text-gray-700">ID</th>
                                <th class="p-4 border-b font-semibold text-gray-700">Date</th>
                                <th class="p-4 border-b font-semibold text-gray-700">Scores (1-5)</th>
                                <th class="p-4 border-b font-semibold text-gray-700">Categories</th>
                                <th class="p-4 border-b font-semibold text-gray-700">Total</th>
                                <th class="p-4 border-b font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($results as $result)
                                <tr class="hover:bg-gray-50 border-b">
                                    <td class="p-4 text-gray-800 font-semibold">#{{ $result->id }}</td>
                                    <td class="p-4 text-gray-600">{{ $result->created_at->format('d M Y H:i') }}</td>
                                    <td class="p-4 text-gray-600">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="inline-block mr-2 text-xs">S{{ $i }}: {{ $result->{"sila{$i}_score"} }}</span>
                                        @endfor
                                    </td>
                                    <td class="p-4">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @php
                                                $category = $result->{"sila{$i}_category"};
                                                $color = match ($category) {
                                                    'Tinggi' => 'bg-green-100 text-green-800',
                                                    'Cukup' => 'bg-yellow-100 text-yellow-800',
                                                    'Rendah' => 'bg-red-100 text-red-800'
                                                };
                                            @endphp
                                            <span class="inline-block px-2 py-1 mr-1 mb-1 rounded text-xs font-semibold {{ $color }}">S{{ $i }}: {{ $category }}</span>
                                        @endfor
                                    </td>
                                    <td class="p-4">
                                        <div class="font-semibold text-gray-800">{{ $result->total_score }} / 75</div>
                                        <div class="text-sm text-gray-500">{{ number_format($result->total_percentage, 1) }}%</div>
                                    </td>
                                    <td class="p-4 flex gap-2">
                                        <a href="{{ route('admin.results.show', $result->id) }}" class="text-red-600 hover:text-red-800 font-semibold">
                                            View Details
                                        </a>
                                        <form action="{{ route('admin.results.destroy', $result->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this result?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-500 italic">
                                        No submissions found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-4 border-t">
                    {{ $results->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
