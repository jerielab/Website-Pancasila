<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Penerapan Nilai Pancasila</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 50%, #ef4444 100%);
        }
        .btn-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(220, 38, 38, 0.4);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .glass-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card:hover {
            transform: scale(1.03);
            box-shadow: 0 20px 40px -10px rgba(220, 38, 38, 0.3);
        }
        .input-focus:focus {
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1);
        }
        .pulse-dot {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .marquee-container {
            overflow: hidden;
            white-space: nowrap;
            width: 100%;
        }
        .marquee {
            display: inline-flex;
            gap: 1.5rem;
            white-space: nowrap;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }
        .left-to-right {
            animation: scroll-left 40s linear infinite;
        }
        .right-to-left {
            animation: scroll-right 40s linear infinite;
        }
        @keyframes scroll-left {
            from { transform: translateX(-50%); }
            to { transform: translateX(0%); }
        }
        @keyframes scroll-right {
            from { transform: translateX(0%); }
            to { transform: translateX(-50%); }
        }
        .marquee-container:hover .marquee {
            animation-play-state: paused;
        }
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .fade-in {
            animation: fade-in 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-red-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-red-100">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-red-800 rounded-2xl flex items-center justify-center shadow-xl">
                    <span class="text-white font-bold text-2xl">P</span>
                </div>
                <div>
                    <h1 class="text-xl font-extrabold text-gray-800">Museum Pancasila</h1>
                    <p class="text-xs text-gray-500">Nilai Indonesia</p>
                </div>
            </div>
            <nav class="hidden md:flex gap-6 items-center">
                <a href="#about" class="text-gray-700 hover:text-red-700 font-medium transition flex items-center gap-2">
                    Tentang
                </a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="bg-gradient-to-r from-gray-700 to-gray-900 text-white px-5 py-2 rounded-xl font-semibold btn-hover shadow-lg">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-700 font-medium transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Admin
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero-bg text-white py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB2aWV3Qm94PSIwIDAgMTIwIDEyMCI+CjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+CjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiB4PSIwIiB5PSIwIi8+CjwvZz4KPC9zdmc+')] opacity-30"></div>
        <div class="max-w-6xl mx-auto px-4 relative z-10">
            <div class="text-center">
                <span class="inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold mb-6 border border-white/30">
                    ✨ Tes Penerapan Nilai Pancasila
                </span>
                <h2 class="text-5xl md:text-6xl font-black mb-4 leading-tight">
                    Kenali Nilai,
                    <span class="block bg-clip-text text-transparent bg-gradient-to-r from-yellow-200 to-yellow-400">
                        Terapkan Sehari-hari
                    </span>
                </h2>
                <p class="text-xl md:text-2xl mb-10 max-w-2xl mx-auto opacity-95 font-light">
                    Temukan bagaimana Anda menerapkan 5 nilai Pancasila dalam kehidupan
                </p>
                <a href="{{ route('quiz.show') }}" class="inline-block bg-gradient-to-r from-yellow-400 to-yellow-500 text-red-900 font-extrabold px-10 py-4 rounded-full text-xl btn-hover shadow-2xl">
                    Mulai Tes Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Reflection Section -->
    <section class="py-20 bg-white relative">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-red-600 font-semibold uppercase tracking-wider text-sm">Suara Masyarakat</span>
                <h3 class="text-4xl font-black text-gray-800 mt-2">Papan Refleksi Pancasila</h3>
            </div>
            
            <!-- Form -->
            <div class="mb-16 max-w-3xl mx-auto bg-gradient-to-br from-white to-red-50 p-8 rounded-3xl shadow-xl border border-red-100">
                <h4 class="font-bold text-2xl text-gray-800 mb-6 flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-700 rounded-xl flex items-center justify-center">
                        <span class="text-white text-xl">✍️</span>
                    </div>
                    Bagikan Pengalamanmu
                </h4>
                
                @if(session('success'))
                    <div class="mb-6 p-5 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-800 rounded-2xl flex items-center gap-3 fade-in">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <span class="text-green-600 text-xl">✅</span>
                        </div>
                        <div>
                            <p class="font-semibold">Berhasil!</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                
                <form action="{{ route('reflections.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="reflection-content" class="sr-only">Refleksi</label>
                        <textarea id="reflection-content" name="content" rows="4" maxlength="500" 
                            class="w-full rounded-2xl border-2 border-gray-200 bg-white focus:border-red-500 focus:ring-4 focus:ring-red-100 input-focus transition-all text-lg px-5 py-4" 
                            placeholder="Ceritakan pengalamanmu menerapkan nilai-nilai Pancasila dalam kehidupan sehari-hari..." required></textarea>
                        <p class="mt-2 text-xs text-gray-500 flex justify-between">
                            <span class="text-sm font-semibold text-gray-600">Sampaikan refleksi Anda dengan bijak</span>
                            <span id="char-count" class="font-bold text-gray-400">0</span>/500 karakter
                        </p>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-gradient-to-r from-red-600 to-red-800 text-white font-bold px-8 py-3 rounded-xl btn-hover shadow-lg">
                            Kirim Cerita
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Statistics -->
            <div class="grid grid-cols-2 gap-6 max-w-md mx-auto mb-16">
                <div class="bg-gradient-to-br from-red-500 to-red-700 p-6 rounded-3xl text-white card-hover shadow-xl">
                    <div class="text-4xl font-extrabold mb-1">{{ $totalReflections }}</div>
                    <div class="text-red-100 font-semibold">Total Refleksi</div>
                </div>
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-6 rounded-3xl text-gray-900 card-hover shadow-xl">
                    <div class="text-4xl font-extrabold mb-1">{{ $approvedCount }}</div>
                    <div class="text-yellow-100 font-semibold">Disetujui</div>
                </div>
            </div>
            
            <!-- Animated Wall -->
            @if($approvedReflections->count() > 0)
                <h4 class="font-bold text-2xl text-center text-gray-800 mb-10">Cerita dari Masyarakat</h4>
                <div class="overflow-hidden space-y-5">
                    @php
                        $row1 = $approvedReflections->take(4);
                        $remaining = $approvedReflections->slice(4);
                        $row2 = $remaining->take(4);
                        $row3 = $approvedReflections->slice(8)->take(4);
                    @endphp
                    
                    @if($row1->count() > 0)
                    <div class="marquee-container">
                        <div class="marquee left-to-right flex gap-5 whitespace-nowrap">
                            @foreach($row1->merge($row1) as $reflection)
                                <div class="glass-card flex-shrink-0 bg-gradient-to-br from-white to-red-50 backdrop-blur-sm border-2 border-red-100 rounded-2xl p-6 shadow-lg max-w-xs md:max-w-sm">
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 bg-gradient-to-br from-red-100 to-yellow-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                            <span class="text-red-600 text-xl">❝</span>
                                        </div>
                                        <p class="text-gray-700 leading-relaxed text-base whitespace-normal line-clamp-4 font-medium">{{ Str::limit($reflection->content, 100) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if($row2->count() > 0)
                    <div class="marquee-container">
                        <div class="marquee right-to-left flex gap-5 whitespace-nowrap">
                            @foreach($row2->merge($row2) as $reflection)
                                <div class="glass-card flex-shrink-0 bg-gradient-to-br from-white to-yellow-50 backdrop-blur-sm border-2 border-yellow-100 rounded-2xl p-6 shadow-lg max-w-xs md:max-w-sm">
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                            <span class="text-yellow-700 text-xl">❝</span>
                                        </div>
                                        <p class="text-gray-700 leading-relaxed text-base whitespace-normal line-clamp-4 font-medium">{{ Str::limit($reflection->content, 100) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if($row3->count() > 0)
                    <div class="marquee-container">
                        <div class="marquee left-to-right flex gap-5 whitespace-nowrap">
                            @foreach($row3->merge($row3) as $reflection)
                                <div class="glass-card flex-shrink-0 bg-gradient-to-br from-white to-emerald-50 backdrop-blur-sm border-2 border-emerald-100 rounded-2xl p-6 shadow-lg max-w-xs md:max-w-sm">
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                            <span class="text-emerald-700 text-xl">❝</span>
                                        </div>
                                        <p class="text-gray-700 leading-relaxed text-base whitespace-normal line-clamp-4 font-medium">{{ Str::limit($reflection->content, 100) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <!-- About -->
    <section id="about" class="py-20 bg-gradient-to-br from-gray-50 to-yellow-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-red-600 font-semibold uppercase tracking-wider text-sm">Tentang Tes</span>
                <h3 class="text-4xl font-black text-gray-800 mt-2">Kenali Diri, Terapkan Pancasila</h3>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 card-hover text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-red-100 to-red-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-red-600 text-4xl">📚</span>
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-800">15 Pertanyaan</h4>
                    <p class="text-gray-600">Setiap sila diuji dengan 3 pertanyaan</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 card-hover text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-yellow-700 text-4xl">⏱️</span>
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-800">Cepat & Mudah</h4>
                    <p class="text-gray-600">Hanya butuh 5-10 menit saja</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 card-hover text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-emerald-700 text-4xl">📊</span>
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-800">Hasil Instan</h4>
                    <p class="text-gray-600">Dapatkan analisis lengkap secara langsung</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 card-hover text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-blue-700 text-4xl">🔒</span>
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-800">100% Anonim</h4>
                    <p class="text-gray-600">Tidak perlu login untuk mengikuti tes</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-gradient-to-r from-red-700 to-red-900">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h3 class="text-3xl md:text-4xl font-black text-white mb-5">Siap Mencoba?</h3>
            <p class="text-xl text-red-100 mb-10">Dapatkan gambaran penerapan nilai Pancasila dalam hidupmu hari ini!</p>
            <a href="{{ route('quiz.show') }}" class="inline-block bg-gradient-to-r from-yellow-400 to-yellow-500 text-red-900 font-extrabold px-10 py-4 rounded-full text-lg btn-hover shadow-2xl">
                Mulai Tes Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h4 class="text-white font-bold text-xl mb-4 flex items-center gap-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-red-600 to-red-800 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">P</span>
                        </div>
                        Museum Pancasila
                    </h4>
                    <p class="text-gray-400">Menumbuhkan nilai-nilai kebangsaan melalui pengalaman interaktif</p>
                </div>
                <div>
                    <h5 class="text-white font-semibold mb-4">Navigasi</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#about" class="hover:text-white transition">Tentang Tes</a></li>
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-semibold mb-4">Admin</h5>
                    <p class="text-gray-400">Untuk login sebagai admin, klik tombol di atas.</p>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-500">
                <p>&copy; {{ date('Y') }} Museum Pancasila. Semua hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('reflection-content');
            const charCount = document.getElementById('char-count');
            
            if (textarea && charCount) {
                textarea.addEventListener('input', function() {
                    charCount.textContent = this.value.length;
                    
                    if (this.value.length >= 450) {
                        charCount.classList.remove('text-gray-400');
                        charCount.classList.add('text-red-500', 'font-bold');
                    } else {
                        charCount.classList.remove('text-red-500', 'font-bold');
                        charCount.classList.add('text-gray-400');
                    }
                });
            }
        });
    </script>
</body>
</html>
