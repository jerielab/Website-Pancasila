<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Questionnaire Result #' . $result->id) }}
            </h2>
            <div class="flex gap-4">
                <a href="{{ route('admin.results') }}" class="text-gray-600 hover:text-red-600 font-medium transition">
                    &larr; Back to Results
                </a>
                <form action="{{ route('admin.results.destroy', $result->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this result?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition">
                        Delete Result
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <!-- Summary -->
            <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-2xl text-white p-8 mb-8">
                <div class="text-center">
                    <p class="text-lg opacity-90 mb-2">Total Score</p>
                    <div class="text-5xl font-bold mb-2">{{ $result->total_score }} / 75</div>
                    <div class="text-2xl font-semibold mb-2">{{ number_format($result->total_percentage, 1) }}%</div>
                    <p class="text-sm opacity-80">Submitted on {{ $result->created_at->format('d F Y H:i') }}</p>
                </div>
            </div>

            <!-- Sila Scores -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                @for ($i = 1; $i <= 5; $i++)
                    @php
                        $scoreKey = "sila{$i}_score";
                        $percentKey = "sila{$i}_percentage";
                        $categoryKey = "sila{$i}_category";
                        $score = $result->$scoreKey;
                        $percentage = $result->$percentKey;
                        $category = $result->$categoryKey;
                        $name = $silaNames[$i];
                        $color = match ($category) {
                            'Tinggi' => 'bg-green-500',
                            'Cukup' => 'bg-yellow-500',
                            'Rendah' => 'bg-red-500'
                        };
                        $textColor = match ($category) {
                            'Tinggi' => 'text-green-600',
                            'Cukup' => 'text-yellow-600',
                            'Rendah' => 'text-red-600'
                        };
                        $bgColor = match ($category) {
                            'Tinggi' => 'bg-green-100',
                            'Cukup' => 'bg-yellow-100',
                            'Rendah' => 'bg-red-100'
                        };
                    @endphp
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-gray-800 mb-4">Sila {{ $i }}: {{ $name }}</h3>
                        <div class="flex items-center gap-4 mb-4">
                            <span class="text-3xl font-extrabold text-gray-900">{{ $score }}</span>
                            <span class="text-gray-500">/ 15 ({{ number_format($percentage, 1) }}%)</span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $textColor }} {{ $bgColor }}">{{ $category }}</span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden mb-4">
                            <div class="h-full {{ $color }}" style="width: {{ $percentage }}%;"></div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $interpretations[$i][$category] }}</p>
                    </div>
                @endfor
            </div>

            <!-- All 15 Questions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6">All Question Responses</h3>
                <div class="space-y-6">
                    @php
                        $qIndex = 1;
                    @endphp
                    @for ($sila = 1; $sila <= 5; $sila++)
                        <div class="border-t border-gray-200 pt-6">
                            <h4 class="font-semibold text-lg text-gray-700 mb-4">{{ $silaNames[$sila] }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach ($questions as $question)
                                    @if ($question->sila_number === $sila)
                                        @php
                                            $answer = $result->answers[$question->id] ?? null;
                                        @endphp
                                        <div class="p-4 bg-gray-50 rounded-lg">
                                            <p class="text-gray-700 mb-3 font-medium">{{ $qIndex }}. {{ $question->question_text }}</p>
                                            <p class="text-sm text-gray-600">
                                                <strong class="text-red-600">{{ $answer ? $likertScale[$answer] : 'No answer' }}</strong>
                                                (Score: {{ $answer }})
                                            </p>
                                        </div>
                                        @php $qIndex++; @endphp
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
