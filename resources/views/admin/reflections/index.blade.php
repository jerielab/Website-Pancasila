<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800">Refleksi Masyarakat</h2>
            <a href="{{ route('home') }}#reflections" target="_blank" class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 px-5 py-2 rounded-xl font-semibold hover:from-yellow-600 hover:to-yellow-700 transition shadow-lg">
                Lihat di Website
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-yellow-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden rounded-3xl shadow-xl border border-gray-100 p-8">
                <!-- Search & Filter -->
                <div class="mb-8 space-y-4">
                    <form action="{{ route('admin.reflections') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                        <div class="flex-1 min-w-[250px]">
                            <label class="text-sm font-semibold text-gray-700 mb-1 block">Cari Refleksi</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik kata kunci..." class="w-full rounded-2xl border-2 border-gray-200 focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all px-5 py-3">
                        </div>
                        <div class="w-full sm:w-auto">
                            <label class="text-sm font-semibold text-gray-700 mb-1 block">Filter Status</label>
                            <select name="status" class="w-full rounded-2xl border-2 border-gray-200 focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all px-5 py-3">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                            </select>
                        </div>
                        <div class="flex gap-3">
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-3 rounded-2xl font-semibold btn-hover shadow-lg">
                                Cari
                            </button>
                            <a href="{{ route('admin.reflections') }}" class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-6 py-3 rounded-2xl font-semibold btn-hover shadow-lg">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                @if(session('success'))
                    <div class="mb-8 p-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-800 rounded-2xl flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <span class="text-green-600 text-2xl">✅</span>
                        </div>
                        <div>
                            <p class="font-bold text-lg">Berhasil!</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-2 border-gray-200 bg-gradient-to-r from-gray-50 to-yellow-50">
                                <th class="py-5 px-6 font-extrabold text-gray-800 text-lg">Refleksi</th>
                                <th class="py-5 px-6 font-extrabold text-gray-800 text-lg w-40">Tanggal</th>
                                <th class="py-5 px-6 font-extrabold text-gray-800 text-lg w-40">Status</th>
                                <th class="py-5 px-6 font-extrabold text-gray-800 text-lg w-52">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reflections as $reflection)
                                <tr class="border-b border-gray-100 hover:bg-yellow-50 transition-colors">
                                    <td class="py-5 px-6 text-gray-700 leading-relaxed">{{ $reflection->content }}</td>
                                    <td class="py-5 px-6 text-sm text-gray-500 font-semibold">{{ $reflection->created_at->format('d M Y, H:i') }}</td>
                                    <td class="py-5 px-6">
                                        @if($reflection->is_approved)
                                            <span class="px-4 py-2 bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 rounded-full text-xs font-bold border border-green-200">Disetujui</span>
                                        @else
                                            <span class="px-4 py-2 bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 rounded-full text-xs font-bold border border-yellow-200">Menunggu</span>
                                        @endif
                                    </td>
                                    <td class="py-5 px-6 flex gap-3">
                                        @if(!$reflection->is_approved)
                                            <form action="{{ route('admin.reflections.approve', $reflection) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-4 py-2 rounded-xl font-semibold text-sm btn-hover shadow-md">
                                                    Setujui
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.reflections.delete', $reflection) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus refleksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 text-white px-4 py-2 rounded-xl font-semibold text-sm btn-hover shadow-md">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-16 text-center text-gray-400 italic">
                                        <div class="text-6xl mb-4">📭</div>
                                        <p class="text-xl font-semibold">Tidak ada refleksi ditemukan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($reflections->count() > 0)
                    <div class="mt-8 p-4 bg-gray-50 rounded-2xl border border-gray-200">
                        {{ $reflections->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
