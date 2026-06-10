<?php

namespace App\Http\Controllers;

use App\Models\Reflection;
use Illuminate\Http\Request;

class ReflectionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        Reflection::create([
            'content' => $request->content,
            'is_approved' => false,
        ]);

        return back()->with('success', 'Ceritamu berhasil dikirim! Akan ditampilkan setelah disetujui.');
    }
}
