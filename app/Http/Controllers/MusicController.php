<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Song;
use App\Models\Artist;
use App\Models\Album;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    // Show the form to add new music

    public function index()
    {
        // Retrieve all songs and albums
        $songs = Song::all();
        $albums = Album::all();

        return view('pages.admin.music.index', compact('songs', 'albums'));
    }
    public function create()
    {
        $artists = Artist::all(); // Fetch all artists
        return view('pages.admin.music.create', compact('artists'));
        }

    // Store the new music in the database
    public function store(Request $request)
    {
        // Validation for Album or Song
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:song,album', // Ensures only 'song' or 'album' are accepted
            'artist_ids' => 'required|array',
            'artist_ids.*' => 'exists:artists,id', // Ensures artist IDs exist in the database
            'cover_art' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'audio_file' => 'nullable|file|max:100000',
            'release_date' => 'nullable|date',
        ]);
    
        // Handle Song and Album creation
        if ($validated['type'] == 'song') {
            $music = new Song();
            $this->storeSongData($request, $music, $validated);
        } else {
            $music = new Album();
            $this->storeAlbumData($request, $music, $validated);
        }
    
        return redirect()->route('music.index')->with('success', ucfirst($validated['type']) . ' uploaded successfully!');
    }
    
    private function storeSongData(Request $request, Song $music, $validated)
    {
        $music->title = $validated['title'];
        $music->release_date = $validated['release_date'] ?? null;
    
        // Upload Cover Art
        if ($request->hasFile('cover_art')) {
            $coverPath = $request->file('cover_art')->store('covers', 'public');
            $music->cover_art = $coverPath;
        }
    
        // Upload Audio File with Original Filename
        if ($request->hasFile('audio_file')) {
            $audioFile = $request->file('audio_file');
            $audioExtension = $audioFile->getClientOriginalExtension();  // Get the original file extension
            $audioFilename = $audioFile->getClientOriginalName();  // Get the original file name
            $audioPath = $audioFile->storeAs('audio', $audioFilename, 'public');  // Save with the original filename
            $music->file_path = $audioPath;
        }
    
        $music->save();
    
        // Attach artists (many-to-many)
        $music->artists()->attach($validated['artist_ids']);
    }
    

    
    private function storeAlbumData(Request $request, Album $music, $validated)
    {
        $music->title = $validated['title'];
        $music->release_date = $validated['release_date'] ?? null;
    
        // Upload Cover Art
        if ($request->hasFile('cover_art')) {
            $coverPath = $request->file('cover_art')->store('covers', 'public');
            $music->cover_art = $coverPath;
        }
    
        $music->save();
    
        // Attach artists (many-to-many)
        $music->artists()->attach($validated['artist_ids']);
    }
    

    // Show a specific music item
    public function show($id)
    {
        $music = Music::with('songs')->findOrFail($id);
        return view('pages.admin.music.show', compact('music'));
    }


    public function destroy($id)
    {
        $music = Song::find($id) ?? Album::find($id);

        if ($music) {
            $music->delete();
            return redirect()->route('pages.admin.music.index')->with('success', 'Music deleted successfully.');
        }

        return redirect()->route('pages.admin.music.index')->with('error', 'Music not found.');
    }
}


// Show the music index page
