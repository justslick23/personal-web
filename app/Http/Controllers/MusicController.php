<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Song;
use App\Models\Artist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    // Show the form to add new music
    public function create()
    {
        $artists = Artist::all(); // Fetch all artists
        return view('pages.admin.music.create', compact('artists'));
        }

    // Store the new music in the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'artist' => 'required|string|max:255', // Assuming the artist name is sent via form
            'album' => 'nullable|string|max:255',
            'type' => 'required|in:song,album',
            'file' => 'nullable|mimes:mp3,wav|max:10240',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Cover image for both songs and albums
            'songs.*' => 'nullable|mimes:mp3,wav|max:10240', // Multiple songs for album
        ]);
    
        // Check if the artist exists in the database, if not, create a new one
        if ($request->artist === 'new_artist' && $request->new_artist_name) {
            // Create a new artist if selected option is "Add New Artist"
            $artist = \App\Models\Artist::create([
                'name' => $request->new_artist_name,
            ]);
        } else {
            // Otherwise, use the selected artist
            $artist = \App\Models\Artist::findOrFail($request->artist);
        }
    
        // Handle cover image upload (for both songs and albums)
        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('cover_images', 'public');
        }
    
        // Create the music entry (either song or album)
        $music = Music::create([
            'name' => $request->name,
            'artist_id' => $artist->id, // Associate music with artist
            'album' => $request->album,
            'type' => $request->type,
            'cover_image' => $coverImagePath, // Store cover image even for songs
        ]);
    
        // If it's an album, handle the multiple songs
        if ($request->type === 'album' && $request->hasFile('songs')) {
            foreach ($request->file('songs') as $songFile) {
                $songPath = $songFile->store('music_files', 'public');
    
                // Create each song record and associate it with the album
                Song::create([
                    'name' => $songFile->getClientOriginalName(),
                    'file_path' => $songPath,
                    'album_id' => $music->id, // Link song to the album
                ]);
            }
        } elseif ($request->type === 'song' && $request->hasFile('file')) {
            $filePath = $request->file('file')->store('music_files', 'public');
    
            // Create a song record
            Song::create([
                'name' => $request->name,
                'file_path' => $filePath,
                'album_id' => null, // Null because it's a standalone song, not part of an album
            ]);
        }
    
        return redirect()->route('music.index')->with('success', 'Music added successfully!');
    }
    
    
    
    public function index()
    {
        $music = Music::with('songs')->get();
        return view('pages.admin.music.index', compact('music'));
    }

    // Show a specific music item
    public function show($id)
    {
        $music = Music::with('songs')->findOrFail($id);
        return view('pages.admin.music.show', compact('music'));
    }
}

// Show the music index page
