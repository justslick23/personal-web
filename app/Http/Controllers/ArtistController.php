<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function create()
    {
        return view('artists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $artist = new Artist();
        $artist->name = $request->input('name');
        $artist->bio = $request->input('bio', ''); // Optional field

        $artist->save();

        return redirect()->route('music.index')->with('success', 'Artist created successfully!');
    }
}
