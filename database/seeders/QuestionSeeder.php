<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            // Sila 1
            [
                'sila' => 'Ketuhanan Yang Maha Esa',
                'sila_number' => 1,
                'question_text' => 'Saya beribadah sesuai agama yang saya anut.',
                'question_order' => 1
            ],
            [
                'sila' => 'Ketuhanan Yang Maha Esa',
                'sila_number' => 1,
                'question_text' => 'Saya menghormati teman yang memiliki agama berbeda.',
                'question_order' => 2
            ],
            [
                'sila' => 'Ketuhanan Yang Maha Esa',
                'sila_number' => 1,
                'question_text' => 'Saya tidak mengejek keyakinan orang lain.',
                'question_order' => 3
            ],

            // Sila 2
            [
                'sila' => 'Kemanusiaan yang Adil dan Beradab',
                'sila_number' => 2,
                'question_text' => 'Saya membantu teman yang mengalami kesulitan.',
                'question_order' => 1
            ],
            [
                'sila' => 'Kemanusiaan yang Adil dan Beradab',
                'sila_number' => 2,
                'question_text' => 'Saya memperlakukan semua orang dengan sopan tanpa membedakan latar belakang.',
                'question_order' => 2
            ],
            [
                'sila' => 'Kemanusiaan yang Adil dan Beradab',
                'sila_number' => 2,
                'question_text' => 'Saya peduli terhadap orang yang sedang mengalami masalah.',
                'question_order' => 3
            ],

            // Sila 3
            [
                'sila' => 'Persatuan Indonesia',
                'sila_number' => 3,
                'question_text' => 'Saya berteman dengan siapa saja tanpa membedakan suku atau agama.',
                'question_order' => 1
            ],
            [
                'sila' => 'Persatuan Indonesia',
                'sila_number' => 3,
                'question_text' => 'Saya mengutamakan kerukunan dibandingkan pertengkaran.',
                'question_order' => 2
            ],
            [
                'sila' => 'Persatuan Indonesia',
                'sila_number' => 3,
                'question_text' => 'Saya menghargai keberagaman yang ada di lingkungan saya.',
                'question_order' => 3
            ],

            // Sila 4
            [
                'sila' => 'Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan',
                'sila_number' => 4,
                'question_text' => 'Saya mendengarkan pendapat orang lain saat berdiskusi.',
                'question_order' => 1
            ],
            [
                'sila' => 'Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan',
                'sila_number' => 4,
                'question_text' => 'Saya ikut berpartisipasi dalam pengambilan keputusan kelompok.',
                'question_order' => 2
            ],
            [
                'sila' => 'Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan',
                'sila_number' => 4,
                'question_text' => 'Saya menerima hasil musyawarah meskipun berbeda dengan pendapat saya.',
                'question_order' => 3
            ],

            // Sila 5
            [
                'sila' => 'Keadilan Sosial bagi Seluruh Rakyat Indonesia',
                'sila_number' => 5,
                'question_text' => 'Saya membagi tugas kelompok secara adil.',
                'question_order' => 1
            ],
            [
                'sila' => 'Keadilan Sosial bagi Seluruh Rakyat Indonesia',
                'sila_number' => 5,
                'question_text' => 'Saya tidak memilih teman berdasarkan status sosial atau ekonomi.',
                'question_order' => 2
            ],
            [
                'sila' => 'Keadilan Sosial bagi Seluruh Rakyat Indonesia',
                'sila_number' => 5,
                'question_text' => 'Saya berusaha memperlakukan semua orang secara setara.',
                'question_order' => 3
            ]
        ];

        foreach ($questions as $questionData) {
            Question::create($questionData);
        }
    }
}
