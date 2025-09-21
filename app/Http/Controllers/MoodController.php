<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\Request;

class MoodController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('moods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'mood' => 'required|string|max:255',
            'score' => 'nullable|integer|min:1|max:10',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('mood_images', 'public');
        }

        $request->user()->moods()->create([
            'date' => $request->date,
            'mood' => $request->mood,
            'score' => $request->score,
            'notes' => $request->notes,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Mood saved successfully!');
    }
}
