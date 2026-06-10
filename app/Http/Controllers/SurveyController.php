<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyOption;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SurveyController extends Controller
{
    public function vote(Request $request)
    {
        $request->validate([
            'survey_option_id' => 'required|exists:survey_options,id',
        ]);

        $option = SurveyOption::findOrFail($request->survey_option_id);
        $surveyId = $option->survey_id;

        // Check if user has already voted for this survey
        $cookieName = 'voted_survey_' . $surveyId;
        if ($request->cookie($cookieName)) {
            return back()->with('error', 'You have already voted in this survey.');
        }

        Vote::create([
            'survey_option_id' => $request->survey_option_id,
        ]);

        // Set cookie for 30 days
        Cookie::queue($cookieName, true, 60 * 24 * 30);

        return back()->with('success', 'Thank you for your vote!')->with('show_results', $surveyId);
    }
}
