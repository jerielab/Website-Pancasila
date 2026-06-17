<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            // Sila ke-1: Ketuhanan Yang Maha Esa
            [
                'sila' => 'Ketuhanan Yang Maha Esa',
                'sila_number' => 1,
                'question_text' => 'Saya melaksanakan ibadah sesuai ajaran agama saya secara rutin.',
                'question_order' => 1
            ],
            [
                'sila' => 'Ketuhanan Yang Maha Esa',
                'sila_number' => 1,
                'question_text' => 'Saya tidak mengganggu teman yang sedang menjalankan ibadah atau kegiatan keagamaan.',
                'question_order' => 2
            ],
            [
                'sila' => 'Ketuhanan Yang Maha Esa',
                'sila_number' => 1,
                'question_text' => 'Saya tetap bekerja sama dengan teman yang memiliki agama atau kepercayaan berbeda.',
                'question_order' => 3
            ],

            // Sila ke-2: Kemanusiaan yang Adil dan Beradab
            [
                'sila' => 'Kemanusiaan yang Adil dan Beradab',
                'sila_number' => 2,
                'question_text' => 'Saya membantu teman yang mengalami kesulitan belajar ketika saya mampu membantu.',
                'question_order' => 1
            ],
            [
                'sila' => 'Kemanusiaan yang Adil dan Beradab',
                'sila_number' => 2,
                'question_text' => 'Saya menggunakan bahasa yang sopan saat berbicara dengan teman maupun guru.',
                'question_order' => 2
            ],
            [
                'sila' => 'Kemanusiaan yang Adil dan Beradab',
                'sila_number' => 2,
                'question_text' => 'Saya berusaha mendengarkan dan memahami perasaan teman yang sedang menghadapi masalah.',
                'question_order' => 3
            ],

            // Sila ke-3: Persatuan Indonesia
            [
                'sila' => 'Persatuan Indonesia',
                'sila_number' => 3,
                'question_text' => 'Saya bersedia bekerja dalam kelompok dengan teman dari suku atau agama yang berbeda.',
                'question_order' => 1
            ],
            [
                'sila' => 'Persatuan Indonesia',
                'sila_number' => 3,
                'question_text' => 'Saya berusaha menyelesaikan konflik melalui komunikasi yang baik.',
                'question_order' => 2
            ],
            [
                'sila' => 'Persatuan Indonesia',
                'sila_number' => 3,
                'question_text' => 'Saya menghargai tradisi atau kebiasaan yang berbeda dari budaya saya.',
                'question_order' => 3
            ],

            // Sila ke-4: Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan
            [
                'sila' => 'Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan',
                'sila_number' => 4,
                'question_text' => 'Saya memberi kesempatan kepada orang lain untuk menyampaikan pendapatnya saat diskusi.',
                'question_order' => 1
            ],
            [
                'sila' => 'Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan',
                'sila_number' => 4,
                'question_text' => 'Saya menyampaikan pendapat atau usulan ketika mengikuti diskusi kelompok.',
                'question_order' => 2
            ],
            [
                'sila' => 'Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan',
                'sila_number' => 4,
                'question_text' => 'Saya menjalankan hasil keputusan kelompok meskipun usulan saya tidak dipilih.',
                'question_order' => 3
            ],

            // Sila ke-5: Keadilan Sosial bagi Seluruh Rakyat Indonesia
            [
                'sila' => 'Keadilan Sosial bagi Seluruh Rakyat Indonesia',
                'sila_number' => 5,
                'question_text' => 'Saya membagi tugas kelompok sesuai kemampuan dan kesepakatan bersama.',
                'question_order' => 1
            ],
            [
                'sila' => 'Keadilan Sosial bagi Seluruh Rakyat Indonesia',
                'sila_number' => 5,
                'question_text' => 'Saya berteman dengan siapa saja tanpa mempertimbangkan kondisi ekonomi keluarganya.',
                'question_order' => 2
            ],
            [
                'sila' => 'Keadilan Sosial bagi Seluruh Rakyat Indonesia',
                'sila_number' => 5,
                'question_text' => 'Saya memberikan kesempatan yang sama kepada semua anggota kelompok untuk berpartisipasi.',
                'question_order' => 3
            ]
        ];

        foreach ($questions as $questionData) {
            Question::create($questionData);
        }
    }
}
