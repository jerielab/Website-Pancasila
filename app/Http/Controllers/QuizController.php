<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show()
    {
        $questions = Question::orderBy('sila_number')->orderBy('question_order')->get();
        $groupedQuestions = $questions->groupBy('sila_number');
        
        $likertScale = [
            1 => 'Tidak Pernah',
            2 => 'Jarang',
            3 => 'Kadang-kadang',
            4 => 'Sering',
            5 => 'Selalu'
        ];

        $silaNames = [
            1 => 'Ketuhanan Yang Maha Esa',
            2 => 'Kemanusiaan yang Adil dan Beradab',
            3 => 'Persatuan Indonesia',
            4 => 'Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan',
            5 => 'Keadilan Sosial bagi Seluruh Rakyat Indonesia'
        ];

        return view('quiz', compact('groupedQuestions', 'likertScale', 'silaNames'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'answers' => 'required|array|min:15',
            'answers.*' => 'required|integer|between:1,5'
        ]);

        $answers = $validated['answers'];
        $questions = Question::orderBy('sila_number')->orderBy('question_order')->get();
        $groupedQuestions = $questions->groupBy('sila_number');

        $silaScores = [];
        $totalScore = 0;

        foreach ($groupedQuestions as $silaNumber => $silaQuestions) {
            $score = 0;
            foreach ($silaQuestions as $question) {
                $score += $answers[$question->id] ?? 0;
            }
            $silaScores[$silaNumber] = $score;
            $totalScore += $score;
        }

        // Calculate categories and percentages
        $silaData = [];
        $maxPerSila = 15; // 3 questions * 5
        $maxTotal = 75; // 5 silas * 15

        foreach ($silaScores as $silaNumber => $score) {
            $percentage = ($score / $maxPerSila) * 100;
            $category = $this->getCategory($score);
            $silaData[$silaNumber] = [
                'score' => $score,
                'percentage' => $percentage,
                'category' => $category
            ];
        }

        $totalPercentage = ($totalScore / $maxTotal) * 100;

        // Save to database
        $result = Result::create([
            'total_score' => $totalScore,
            'total_percentage' => $totalPercentage,
            'sila1_score' => $silaData[1]['score'],
            'sila1_percentage' => $silaData[1]['percentage'],
            'sila1_category' => $silaData[1]['category'],
            'sila2_score' => $silaData[2]['score'],
            'sila2_percentage' => $silaData[2]['percentage'],
            'sila2_category' => $silaData[2]['category'],
            'sila3_score' => $silaData[3]['score'],
            'sila3_percentage' => $silaData[3]['percentage'],
            'sila3_category' => $silaData[3]['category'],
            'sila4_score' => $silaData[4]['score'],
            'sila4_percentage' => $silaData[4]['percentage'],
            'sila4_category' => $silaData[4]['category'],
            'sila5_score' => $silaData[5]['score'],
            'sila5_percentage' => $silaData[5]['percentage'],
            'sila5_category' => $silaData[5]['category'],
            'answers' => $answers,
        ]);

        return redirect()->route('results.show', $result->id);
    }

    private function getCategory(int $score): string
    {
        if ($score >= 12) return 'Tinggi';
        if ($score >= 8) return 'Cukup';
        return 'Rendah';
    }
}
