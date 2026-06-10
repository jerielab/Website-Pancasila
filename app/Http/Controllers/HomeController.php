<?php

namespace App\Http\Controllers;

use App\Models\Reflection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $approvedReflections = Reflection::where('is_approved', true)->get();
        $totalReflections = Reflection::count();
        $approvedCount = $approvedReflections->count();

        return view('home', compact('approvedReflections', 'totalReflections', 'approvedCount'));
    }
}
