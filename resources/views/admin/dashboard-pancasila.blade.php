<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800">Dashboard Admin</h2>
            <a href="{{ route('home') }}" target="_blank" class="bg-gradient-to-r from-red-600 to-red-700 text-white px-5 py-2 rounded-xl font-semibold hover:from-red-700 hover:to-red-800 transition shadow-lg">
                Lihat Website
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-red-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-8 rounded-3xl shadow-xl border-l-8 border-red-500 card-hover">
                    <div class="text-gray-500 text-sm uppercase font-bold mb-2 flex items-center gap-2">
                        <span class="text-red-500 text-2xl">📊</span>
                        Total Hasil Tes
                    </div>
                    <div class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-red-800">
                        {{ $totalResults }}
                    </div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-xl border-l-8 border-yellow-500 card-hover">
                    <div class="text-gray-500 text-sm uppercase font-bold mb-2 flex items-center gap-2">
                        <span class="text-yellow-500 text-2xl">⭐</span>
                        Rata-rata Skor
                    </div>
                    <div class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-yellow-600 to-yellow-700">
                        {{ number_format($averageScore, 1) }}
                    </div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-xl border-l-8 border-emerald-500 card-hover">
                    <div class="text-gray-500 text-sm uppercase font-bold mb-2 flex items-center gap-2">
                        <span class="text-emerald-500 text-2xl">📈</span>
                        Rata-rata Persentase
                    </div>
                    <div class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-emerald-600 to-emerald-800">
                        {{ number_format($averagePercentage, 1) }}%
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Results -->
                <div class="bg-white overflow-hidden rounded-3xl shadow-xl border border-gray-100">
                    <div class="p-8 border-b border-gray-100 bg-gradient-to-r from-white to-gray-50">
                        <h3 class="text-xl font-extrabold text-gray-800 flex items-center gap-3">
                            <span class="text-red-600">🔍</span>
                            Hasil Terbaru
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($recentResults->count() > 0)
                            <ul class="space-y-4">
                                @foreach($recentResults as $result)
                                    <li class="flex items-center justify-between p-5 bg-gradient-to-r from-gray-50 to-red-50 rounded-2xl border border-gray-100 card-hover">
                                        <div>
                                            <span class="text-gray-500 text-xs uppercase font-semibold">Hasil #{{ $result->id }}</span>
                                            <p class="font-bold text-xl text-gray-800 mt-1">
                                                {{ $result->total_score }} / 75
                                                <span class="text-sm text-gray-500 font-normal">({{ number_format($result->total_percentage, 1) }}%)</span>
                                            </p>
                                        </div>
                                        <a href="{{ route('admin.results.show', $result->id) }}" class="bg-gradient-to-r from-red-600 to-red-700 text-white px-5 py-2 rounded-xl font-semibold text-sm btn-hover">
                                            Lihat Detail
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-center py-12 text-gray-400 italic">
                                Belum ada hasil tes.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Menu -->
                <div class="bg-white overflow-hidden rounded-3xl shadow-xl border border-gray-100">
                    <div class="p-8 border-b border-gray-100 bg-gradient-to-r from-white to-yellow-50">
                        <h3 class="text-xl font-extrabold text-gray-800 flex items-center gap-3">
                            <span class="text-yellow-600">⚡</span>
                            Menu Cepat
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <a href="{{ route('admin.results') }}" class="flex items-center gap-4 p-6 bg-gradient-to-r from-red-50 to-red-100 rounded-2xl hover:from-red-100 hover:to-red-200 transition card-hover">
                                <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-700 rounded-2xl flex items-center justify-center shadow-lg">
                                    <span class="text-white text-2xl">📋</span>
                                </div>
                                <div>
                                    <span class="font-bold text-lg text-gray-800 block">Lihat Semua Hasil Tes</span>
                                    <span class="text-sm text-gray-600">Kelola semua jawaban kuesioner</span>
                                </div>
                            </a>
                            <a href="{{ route('admin.reflections') }}" class="flex items-center gap-4 p-6 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-2xl hover:from-yellow-100 hover:to-yellow-200 transition card-hover">
                                <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-700 rounded-2xl flex items-center justify-center shadow-lg">
                                    <span class="text-white text-2xl">💬</span>
                                </div>
                                <div>
                                    <span class="font-bold text-lg text-gray-800 block">Refleksi Masyarakat</span>
                                    <span class="text-sm text-gray-600">Setujui dan kelola cerita</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
