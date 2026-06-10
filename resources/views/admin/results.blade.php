<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Semua Hasil Tes') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-red-600 font-medium transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="p-4 font-bold text-gray-700">ID</th>
                                <th class="p-4 font-bold text-gray-700">Tanggal</th>
                                <th class="p-4 font-bold text-gray-700">Skor</th>
                                <th class="p-4 font-bold text-gray-700">Persentase</th>
                                <th class="p-4 font-bold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $result)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                    <td class="p-4 text-gray-600">{{ $result->id }}</td>
                                    <td class="p-4 text-gray-600">{{ $result->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="p-4 text-gray-800 font-semibold">{{ $result->total_score }} / 75</td>
                                    <td class="p-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $result->total_percentage >= 70 ? 'text-green-600 bg-green-100' : ($result->total_percentage >=50 ? 'text-yellow-600 bg-yellow-100' : 'text-red-600 bg-red-100') }}">
                                            {{ number_format($result->total_percentage, 1) }}%
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <a href="{{ route('admin.results.show', $result->id) }}" class="text-red-600 hover:text-red-800 font-semibold">Lihat Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4 border-t border-gray-200">
                    {{ $results->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
