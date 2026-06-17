<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tes Pancasila</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .progress-fill {
            transition: width 1s ease-out;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center shadow">
                    <span class="text-white font-bold text-xl">P</span>
                </div>
                <h1 class="text-xl font-bold text-gray-800">Museum Pancasila</h1>
            </a>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-12">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Hasil Tes Anda</h2>
            <p class="text-gray-600">Berikut adalah analisis penerapan nilai Pancasila dalam kehidupan Anda.</p>
        </div>

        <!-- Summary -->
        <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-2xl text-white p-8 mb-8">
            <div class="text-center">
                <p class="text-lg opacity-90 mb-2">Total Skor Anda</p>
                <div class="text-6xl font-bold mb-2">{{ $result->total_score }} / 75</div>
                <div class="text-2xl font-semibold mb-4">{{ number_format($result->total_percentage, 1) }}%</div>
                <a href="{{ route('quiz.show') }}" class="inline-block bg-white text-red-600 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition">
                    Coba Lagi
                </a>
            </div>
        </div>

        <!-- Chart -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Visualisasi Hasil</h3>
            <div class="max-w-md mx-auto">
                <canvas id="radarChart"></canvas>
            </div>
        </div>

        <!-- Detail Sila -->
        <div class="space-y-6">
            <h3 class="text-2xl font-bold text-gray-800">Detail Setiap Sila</h3>
            
            @for($i = 1; $i <=5; $i++)
                @php
                    $scoreKey = 'sila'.$i.'_score';
                    $percentKey = 'sila'.$i.'_percentage';
                    $categoryKey = 'sila'.$i.'_category';
                    $score = $result->$scoreKey;
                    $percentage = $result->$percentKey;
                    $category = $result->$categoryKey;
                    $name = $silaNames[$i];
                    $interpretation = $interpretations[$i][$category];

                    $color = match($category) {
                        'Tinggi' => 'text-green-600',
                        'Cukup' => 'text-yellow-600',
                        'Rendah' => 'text-red-600'
                    };
                    $bgColor = match($category) {
                        'Tinggi' => 'bg-green-500',
                        'Cukup' => 'bg-yellow-500',
                        'Rendah' => 'bg-red-500'
                    };
                @endphp

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Sila {{ $i }}: {{ $name }}</h4>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="font-semibold text-gray-700">Skor: {{ $score }} /15 ({{ number_format($percentage, 1) }}%)</span>
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $color }} bg-opacity-10" style="background-color: {{ str_replace('text-', '', $color) == 'green-600' ? '#dcfce7' : (str_replace('text-', '', $color) == 'yellow-600' ? '#fef3c7' : '#fee2e2') }}">
                                    {{ $category }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Progress -->
                    <div class="mb-4">
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div class="progress-fill h-full rounded-full {{ $bgColor }}" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>

                    <!-- Interpretation -->
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h5 class="font-semibold text-gray-800 mb-2">Interpretasi</h5>
                        <p class="text-gray-600 leading-relaxed">{{ $interpretation }}</p>
                    </div>
                </div>
            @endfor
        </div>

        <!-- Back Home -->
        <div class="text-center mt-10">
            <a href="{{ route('home') }}" class="inline-block bg-gray-800 text-white font-semibold px-8 py-3 rounded-lg hover:bg-gray-900 transition">
                Kembali ke Beranda
            </a>
        </div>
    </main>

    <script>
        const ctx = document.getElementById('radarChart').getContext('2d');
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: [
                    'Ketuhanan',
                    'Kemanusiaan',
                    'Persatuan',
                    'Kerakyatan',
                    'Keadilan'
                ],
                datasets: [{
                    label: 'Persentase',
                    data: [
                        {{ $result->sila1_percentage }},
                        {{ $result->sila2_percentage }},
                        {{ $result->sila3_percentage }},
                        {{ $result->sila4_percentage }},
                        {{ $result->sila5_percentage }}
                    ],
                    backgroundColor: 'rgba(220,38,38,0.2)',
                    borderColor: 'rgba(220,38,38,1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(220,38,38,1)'
                }]
            },
            options: {
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</body>
</html>
