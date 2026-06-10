<?php

namespace Database\Seeders;

use App\Models\Reflection;
use Illuminate\Database\Seeder;

class ReflectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reflections = [
            'Ketika saya membantu tetangga yang kesulitan membawa barang, saya merasakan bagaimana nilai sila kedua tentang kemanusiaan yang adil dan beradab berjalan.',
            'Saya selalu menghormati teman saya yang berbeda agama, karena menurut saya sila pertama tentang ketuhanan yang maha esa juga meliputi menghargai keyakinan orang lain.',
            'Saya selalu mengutamakan musyawarah di kelompok belajar untuk mencapai keputusan bersama.',
            'Saya mencoba untuk selalu adil dalam membagi tugas di kelompok, tidak membeda-bedakan siapapun.',
            'Saya senang berteman dengan orang dari berbagai latar belakang, karena menurut saya keberagaman adalah kekuatan bangsa Indonesia.',
        ];

        foreach ($reflections as $content) {
            Reflection::create([
                'content' => $content,
                'is_approved' => true,
            ]);
        }
    }
}