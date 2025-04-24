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
        // Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:song,album',
            'artist_ids' => 'required_if:new_artist,null|array', // artist_ids is required only if new_artist is not provided
            'artist_ids.*' => 'exists:artists,id',
            'new_artist' => 'nullable|array',
            'new_artist.*' => 'string|max:255',
            'cover_art' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'audio_file' => 'nullable|file|max:100000',
            'release_date' => 'nullable|date',
        ]);
        
        // Add new artists if present
        $newArtistIds = [];
        if (!empty($validated['new_artist'])) {
            foreach ($validated['new_artist'] as $artistName) {
                // Check if the artist already exists
                $existingArtist = Artist::firstOrCreate(['name' => $artistName]);
                $newArtistIds[] = $existingArtist->id;  // Collect new artist ids
            }
        }
        
        // Merge the selected existing artist ids with newly created artists
        $allArtistIds = array_merge($validated['artist_ids'] ?? [], $newArtistIds); // Merge artist ids
        
        // Decide if it's a Song or Album and pass everything forward
        if ($validated['type'] === 'song') {
            $music = new Song();
            $this->storeSongData($request, $music, $validated, $allArtistIds);  // Pass combined artist IDs
        } else {
            $music = new Album();
            $this->storeAlbumData($request, $music, $validated, $allArtistIds);  // Pass combined artist IDs
        }
    
        return redirect()->route('music.index')->with('success', ucfirst($validated['type']) . ' uploaded successfully!');
    }
    
    
    
    
    private function storeSongData(Request $request, Song $music, $validated, $artistIds)
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
        $music->artists()->attach($artistIds);
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
