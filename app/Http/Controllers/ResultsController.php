<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function show($id)
    {
        $result = Result::findOrFail($id);
        
        $silaNames = [
            1 => 'Ketuhanan Yang Maha Esa',
            2 => 'Kemanusiaan yang Adil dan Beradab',
            3 => 'Persatuan Indonesia',
            4 => 'Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan',
            5 => 'Keadilan Sosial bagi Seluruh Rakyat Indonesia'
        ];

        $interpretations = $this->getInterpretations();

        return view('results', compact('result', 'silaNames', 'interpretations'));
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
}
