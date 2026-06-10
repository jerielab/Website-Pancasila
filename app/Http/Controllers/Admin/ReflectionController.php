<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reflection;
use Illuminate\Http\Request;

class ReflectionController extends Controller
{
    public function index(Request $request)
    {
        $query = Reflection::query();

        if ($request->has('search')) {
            $query->where('content', 'like', '%' . $request->search . '%');
        }

        $reflections = $query->latest()->paginate(20);

        return view('admin.reflections.index', compact('reflections'));
    }

    public function destroy(Reflection $reflection)
    {
        $reflection->delete();
        return back()->with('success', 'Reflection deleted successfully.');
    }
}
