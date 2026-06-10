<?php

namespace Database\Seeders;

use App\Models\Reflection;
use App\Models\Survey;
use App\Models\SurveyOption;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Museum',
            'email' => 'admin@museum.go.id',
            'password' => Hash::make('password'),
        ]);

        // Create Reflections
        $reflections = [
            'I learned that Pancasila is the foundation of our unity as a nation. Truly inspiring!',
            'The museum exhibits really helped me understand the history of our five principles.',
            'As a student, seeing the original documents made history feel so much more real.',
            'Diversity in unity is something we must always cherish. Great visit!',
            'The values of social justice should be practiced by every Indonesian citizen.',
        ];

        foreach ($reflections as $content) {
            Reflection::create(['content' => $content]);
        }

        // Create Surveys
        $survey1 = Survey::create([
            'question' => 'Which Pancasila principle do you think is most important to practice in daily life today?',
            'is_active' => true,
        ]);

        $options1 = [
            'Belief in the One and Only God',
            'A Just and Civilized Humanity',
            'The Unity of Indonesia',
            'Democracy through Deliberation/Representation',
            'Social Justice for All Indonesian People',
        ];

        foreach ($options1 as $opt) {
            $option = $survey1->options()->create(['option_text' => $opt]);
            
            // Add some random votes
            $voteCount = rand(5, 20);
            for ($i = 0; $i < $voteCount; $i++) {
                Vote::create(['survey_option_id' => $option->id]);
            }
        }

        $survey2 = Survey::create([
            'question' => 'How often do you visit museums to learn about Indonesian history?',
            'is_active' => false,
        ]);

        $options2 = [
            'First time visit',
            'Once a year',
            'Every few months',
            'Regularly',
        ];

        foreach ($options2 as $opt) {
            $survey2->options()->create(['option_text' => $opt]);
        }
    }
}
