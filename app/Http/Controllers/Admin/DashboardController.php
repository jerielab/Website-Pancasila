<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reflection;
use App\Models\Survey;
use App\Models\Vote;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalReflections = Reflection::count();
        $totalSurveys = Survey::count();
        $totalVotes = Vote::count();
        $activeSurvey = Survey::where('is_active', true)->first();

        return view('admin.dashboard', compact('totalReflections', 'totalSurveys', 'totalVotes', 'activeSurvey'));
    }
}
