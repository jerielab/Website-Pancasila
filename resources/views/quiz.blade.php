<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Penerapan Nilai Pancasila</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .option-btn {
            transition: all 0.2s ease;
        }
        .option-btn:hover {
            transform: scale(1.02);
        }
        .option-btn.selected {
            border-color: #dc2626;
            background-color: #fef2f2;
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

    <main class="max-w-4xl mx-auto px-4 py-12">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Tes Penerapan Nilai Pancasila</h2>
            <p class="text-gray-600">Jawablah pertanyaan berikut dengan jujur sesuai dengan kehidupan sehari-hari Anda.</p>
        </div>

        <form id="quizForm" action="{{ route('quiz.submit') }}" method="POST" class="space-y-10">
            @csrf

            @foreach($groupedQuestions as $silaNumber => $questions)
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center text-sm font-bold">
                            {{ $silaNumber }}
                        </span>
                        {{ $silaNames[$silaNumber] }}
                    </h3>

                    <div class="space-y-6">
                        @foreach($questions as $index => $question)
                            <div class="pb-6 border-b border-gray-100 last:border-0 last:pb-0">
                                <p class="font-medium text-gray-800 mb-4">{{ $index + 1 }}. {{ $question->question_text }}</p>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-5 gap-2">
                                    @foreach($likertScale as $value => $label)
                                        <label class="option-btn cursor-pointer">
                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $value }}" required class="sr-only peer">
                                            <div class="border-2 border-gray-200 rounded-lg p-3 text-center hover:border-red-300 peer-checked:border-red-500 peer-checked:bg-red-50 transition">
                                                <span class="block text-sm font-semibold text-gray-700">{{ $value }}</span>
                                                <span class="text-xs text-gray-500 mt-1">{{ $label }}</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="flex justify-center pt-6">
                <button type="submit" class="bg-red-600 text-white font-semibold px-12 py-4 rounded-lg text-lg hover:bg-red-700 transition transform hover:scale-105 shadow-lg">
                    Lihat Hasil
                </button>
            </div>
        </form>
    </main>
</body>
</html>
