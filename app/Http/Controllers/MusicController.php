<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Song;
use App\Models\Artist;
use App\Models\Album;
use Illuminate\Support\Str;

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
        // Base validation for all types
        $baseRules = [
            'title' => 'required|string|max:255',
            'type' => 'required|in:song,album',
            'artist_ids' => 'nullable|array', // Made nullable since we check for at least one artist below
            'artist_ids.*' => 'exists:artists,id',
          'new_artist' => 'nullable|array|min:1',
            'new_artist.*' => 'nullable|string|max:255',

            'cover_art' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'release_date' => 'nullable|date',
        ];
        
        // Add specific rules based on type
        if ($request->type === 'song') {
            $rules = array_merge($baseRules, [
                'audio_file' => 'nullable|file|max:100000',
            ]);
        } else { // album
            $rules = array_merge($baseRules, [
                'songs' => 'required|array|min:1',
                'songs.*.title' => 'required|string|max:255',
                'songs.*.audio_file' => 'nullable|file|max:100000',
                'songs.*.track_number' => 'required|integer|min:1',
            ]);
        }
        
        // Validate request
        $validated = $request->validate($rules);
        
        // Add new artists if present
        $newArtistIds = [];
        if (!empty($request->new_artist)) {
            foreach ($request->new_artist as $artistName) {
                if (!empty($artistName)) {
                    // Split by commas if multiple artists are entered
                    $artistNames = array_map('trim', explode(',', $artistName));
                    
                    foreach ($artistNames as $name) {
                        if (!empty($name)) {
                            // Check if the artist already exists
                            $existingArtist = Artist::firstOrCreate(['name' => $name]);
                            $newArtistIds[] = $existingArtist->id;  // Collect new artist ids
                        }
                    }
                }
            }
        }
        
        // Merge the selected existing artist ids with newly created artists
        $allArtistIds = array_merge($request->artist_ids ?? [], $newArtistIds);
        
        // Require at least one artist
        if (empty($allArtistIds)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['artist' => 'At least one artist must be selected or created.']);
        }
        
        // Decide if it's a Song or Album and process accordingly
        if ($request->type === 'song') {
            $music = new Song();
            $this->storeSongData($request, $music, $validated, $allArtistIds);
        } else {
            $music = new Album();
            $this->storeAlbumData($request, $music, $validated, $allArtistIds);
        }
        
        return redirect()->route('music.index')->with('success', ucfirst($request->type) . ' uploaded successfully!');
    }
    

    private function storeSongData(Request $request, Song $music, $validated, $artistIds)
    {
        $music->title = $validated['title'];
        $music->release_date = $validated['release_date'] ?? null;
    
        // Generate slug from title
        $music->slug = Str::slug($validated['title']);
    
        // Upload Cover Art
        if ($request->hasFile('cover_art')) {
            $coverPath = $request->file('cover_art')->store('covers', 'public');
            $music->cover_art = $coverPath;
        }
    
        // Upload Audio File with song-title-based filename
        if ($request->hasFile('audio_file')) {
            $audioFile = $request->file('audio_file');
    
            // Sanitize and create filename from song title and extension
            $extension = $audioFile->getClientOriginalExtension();
            $audioFilename = Str::slug($validated['title']) . '.' . $extension;
    
            // Store the file with the custom filename
            $audioPath = $audioFile->storeAs('audio', $audioFilename, 'public');
            $music->file_path = $audioPath;
        }
    
        $music->save();
    
        // Attach artists (many-to-many using artist_song pivot table)
        foreach ($artistIds as $artistId) {
            $music->artists()->attach($artistId);
        }
    }
    
    
    
    private function storeAlbumData(Request $request, Album $music, $validated, $artistIds)
{
    $music->title = $validated['title'];
    $music->release_date = $validated['release_date'] ?? null;
    $music->slug = Str::slug($validated['title']); // Create a slug from the album title

    // Upload Cover Art
    if ($request->hasFile('cover_art')) {
        $coverPath = $request->file('cover_art')->store('covers', 'public');
        $music->cover_image = $coverPath;
    }
    
    $music->save();
    
    // Attach artists (many-to-many using artist_song table)
    foreach ($artistIds as $artistId) {
        $music->artists()->attach($artistId); // This will use the artist_song pivot table
    }
    
    // Process all songs for this album
    if (isset($validated['songs']) && is_array($validated['songs'])) {
        foreach ($validated['songs'] as $songData) {
            $song = new Song();
            $song->title = $songData['title'];
            $song->album_id = $music->id; // Connect to this album
            
            // Upload Audio File if provided
            if (isset($songData['audio_file']) && $request->hasFile('songs.' . array_search($songData, $validated['songs']) . '.audio_file')) {
                $audioFileKey = 'songs.' . array_search($songData, $validated['songs']) . '.audio_file';
                $audioFile = $request->file($audioFileKey);
                $audioFilename = $audioFile->getClientOriginalName();
                $audioPath = $audioFile->storeAs('audio', $audioFilename, 'public');
                $song->file_path = $audioPath;
            }
            
            $song->save();
            
            // Attach the same artists to each song as the album
            foreach ($artistIds as $artistId) {
                $song->artists()->attach($artistId); // Use the artist_song pivot table for the song
            }
        }
    }
}


    // Show a specific music item
    public function show($id)
    {
        $music = Music::with('songs')->findOrFail($id);
        return view('pages.admin.music.show', compact('music'));
    }

    public function showAlbum($slug)
    {
        $album = Album::with('songs.songStatistics', 'artists')
                      ->where('slug', $slug)
                      ->firstOrFail();
    
        return view('pages.music.album', compact('album'));
    }
    

    public function display($slug)
            {
                $song = Song::where('slug', $slug)->with('artists')->firstOrFail();
                return view('pages.admin.music.show', compact('song'));
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
