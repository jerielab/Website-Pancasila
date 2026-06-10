<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Result;
use App\Models\Reflection;
use Illuminate\Http\Request;

class PancasilaAdminController extends Controller
{

    public function dashboard()
    {
        $totalResults = Result::count();
        $averageScore = Result::avg('total_score');
        $averagePercentage = Result::avg('total_percentage');
        $recentResults = Result::latest()->take(10)->get();

        return view('admin.dashboard-pancasila', compact('totalResults', 'averageScore', 'averagePercentage', 'recentResults'));
    }

    public function results(Request $request)
    {
        $query = Result::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('id', 'like', "%$search%");
        }

        // Filter by category for each sila
        if ($request->has('sila1_category') && $request->sila1_category) {
            $query->where('sila1_category', $request->sila1_category);
        }
        if ($request->has('sila2_category') && $request->sila2_category) {
            $query->where('sila2_category', $request->sila2_category);
        }
        if ($request->has('sila3_category') && $request->sila3_category) {
            $query->where('sila3_category', $request->sila3_category);
        }
        if ($request->has('sila4_category') && $request->sila4_category) {
            $query->where('sila4_category', $request->sila4_category);
        }
        if ($request->has('sila5_category') && $request->sila5_category) {
            $query->where('sila5_category', $request->sila5_category);
        }

        // Filter by submission date
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $results = $query->latest()->paginate(10)->withQueryString();

        // Summary statistics
        $totalSubmissions = Result::count();
        $averageSila1 = Result::avg('sila1_score');
        $averageSila2 = Result::avg('sila2_score');
        $averageSila3 = Result::avg('sila3_score');
        $averageSila4 = Result::avg('sila4_score');
        $averageSila5 = Result::avg('sila5_score');

        // Percentage per category
        $categoryPercentages = [];
        for ($i = 1; $i <= 5; $i++) {
            $categoryPercentages[$i] = [
                'Tinggi' => $totalSubmissions > 0 ? (Result::where("sila{$i}_category", 'Tinggi')->count() / $totalSubmissions) * 100 : 0,
                'Cukup' => $totalSubmissions > 0 ? (Result::where("sila{$i}_category", 'Cukup')->count() / $totalSubmissions) * 100 : 0,
                'Rendah' => $totalSubmissions > 0 ? (Result::where("sila{$i}_category", 'Rendah')->count() / $totalSubmissions) * 100 : 0
            ];
        }

        $questions = Question::orderBy('sila_number')->orderBy('question_order')->get();
        $silaNames = $this->getSilaNames();
        $likertScale = $this->getLikertScale();

        return view('admin.questionnaire-results', compact(
            'results',
            'totalSubmissions',
            'averageSila1',
            'averageSila2',
            'averageSila3',
            'averageSila4',
            'averageSila5',
            'categoryPercentages',
            'questions',
            'silaNames',
            'likertScale'
        ));
    }

    public function showResult($id)
    {
        $result = Result::findOrFail($id);
        $silaNames = $this->getSilaNames();
        $interpretations = $this->getInterpretations();
        $questions = Question::orderBy('sila_number')->orderBy('question_order')->get();
        $likertScale = $this->getLikertScale();

        return view('admin.show-result', compact('result', 'silaNames', 'interpretations', 'questions', 'likertScale'));
    }

    private function getSilaNames()
    {
        return [
            1 => 'Ketuhanan Yang Maha Esa',
            2 => 'Kemanusiaan yang Adil dan Beradab',
            3 => 'Persatuan Indonesia',
            4 => 'Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan',
            5 => 'Keadilan Sosial bagi Seluruh Rakyat Indonesia'
        ];
    }

    private function getLikertScale()
    {
        return [
            1 => 'Tidak Pernah',
            2 => 'Jarang',
            3 => 'Kadang-kadang',
            4 => 'Sering',
            5 => 'Selalu'
        ];
    }

    private function getInterpretations()
    {
        return [
            1 => [
                'Tinggi' => 'Anda menunjukkan penerapan nilai Ketuhanan Yang Maha Esa yang sangat baik. Anda cenderung menjalankan ajaran agama dengan konsisten serta menghormati perbedaan keyakinan yang ada di sekitar Anda. Sikap toleransi dan penghargaan terhadap keberagaman menjadi salah satu kekuatan Anda.',
                'Cukup' => 'Anda telah menerapkan nilai Ketuhanan Yang Maha Esa dalam kehidupan sehari-hari, namun masih terdapat beberapa aspek yang dapat ditingkatkan. Konsistensi dalam menjalankan ajaran agama dan menghargai perbedaan keyakinan dapat terus dikembangkan.',
                'Rendah' => 'Penerapan nilai Ketuhanan Yang Maha Esa masih perlu ditingkatkan. Anda dapat mulai dengan lebih menghargai perbedaan keyakinan, memperkuat toleransi, serta menerapkan nilai-nilai agama dalam kehidupan sehari-hari.'
            ],
            2 => [
                'Tinggi' => 'Anda memiliki rasa empati dan kepedulian sosial yang tinggi. Anda cenderung menghormati orang lain, membantu sesama yang membutuhkan, dan memperlakukan semua orang dengan baik tanpa membedakan latar belakang mereka.',
                'Cukup' => 'Anda telah menunjukkan sikap peduli terhadap sesama, namun masih terdapat kesempatan untuk lebih meningkatkan empati, kepedulian sosial, dan penghargaan terhadap orang lain dalam berbagai situasi.',
                'Rendah' => 'Nilai kemanusiaan masih perlu diperkuat. Anda dapat lebih memperhatikan kebutuhan orang lain, meningkatkan rasa empati, dan membiasakan sikap saling menghormati dalam kehidupan sehari-hari.'
            ],
            3 => [
                'Tinggi' => 'Anda menunjukkan semangat persatuan yang kuat. Anda mampu menghargai keberagaman, menjaga hubungan baik dengan orang lain, dan mengutamakan kerukunan dalam kehidupan bermasyarakat.',
                'Cukup' => 'Anda cukup mampu menjaga persatuan dan menghargai perbedaan. Namun, Anda masih dapat meningkatkan sikap toleransi, kerja sama, dan keterbukaan terhadap keberagaman yang ada di lingkungan sekitar.',
                'Rendah' => 'Nilai persatuan masih perlu ditingkatkan. Anda dapat mulai dengan lebih menghargai perbedaan, membangun kerja sama yang baik, dan menjaga keharmonisan dengan orang-orang di sekitar.'
            ],
            4 => [
                'Tinggi' => 'Anda memiliki kemampuan yang baik dalam bermusyawarah dan bekerja sama. Anda terbuka terhadap pendapat orang lain, aktif berpartisipasi dalam diskusi, serta mampu menerima keputusan bersama dengan bijaksana.',
                'Cukup' => 'Anda telah menunjukkan kemampuan bermusyawarah yang cukup baik. Namun, Anda masih dapat meningkatkan partisipasi dalam diskusi, keberanian menyampaikan pendapat, dan keterbukaan terhadap pandangan yang berbeda.',
                'Rendah' => 'Nilai musyawarah dan demokrasi masih perlu diperkuat. Anda dapat melatih diri untuk lebih aktif berdiskusi, menghargai pendapat orang lain, dan menerima hasil keputusan bersama dengan lapang dada.'
            ],
            5 => [
                'Tinggi' => 'Anda menunjukkan sikap yang adil dan menghargai kesetaraan. Anda berusaha memperlakukan semua orang secara setara, menghormati hak orang lain, dan menghindari perlakuan diskriminatif.',
                'Cukup' => 'Anda telah menerapkan nilai keadilan sosial dengan cukup baik. Namun, Anda masih dapat meningkatkan konsistensi dalam bersikap adil dan menghargai hak setiap individu tanpa membedakan latar belakang mereka.',
                'Rendah' => 'Nilai keadilan sosial masih perlu ditingkatkan. Anda dapat mulai dengan lebih memperhatikan kesetaraan, menghargai hak orang lain, dan berusaha bersikap adil dalam berbagai situasi.'
            ]
        ];
    }

    public function reflections(Request $request)
    {
        $query = Reflection::query();
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('content', 'like', "%$search%");
        }
        
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_approved', $request->status === 'approved');
        }
        
        $reflections = $query->latest()->paginate(10)->withQueryString();
        
        return view('admin.reflections.index', compact('reflections'));
    }

    public function approveReflection(Reflection $reflection)
    {
        $reflection->update(['is_approved' => true]);
        return back()->with('success', 'Refleksi disetujui!');
    }

    public function deleteReflection(Reflection $reflection)
    {
        $reflection->delete();
        return back()->with('success', 'Refleksi dihapus!');
    }

    public function destroyResult($id)
    {
        $result = \App\Models\Result::findOrFail($id);
        $result->delete();
        return back()->with('success', 'Hasil kuesioner dihapus!');
    }
}
