<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Song;
use App\Models\Artist;
use App\Models\Album;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Subscriber;
use App\Mail\NewReleaseNotification;
use Illuminate\Support\Facades\Mail;

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
            $url = route('music.show', ['slug' => $music->slug]);  // For a song

        } else {
            $music = new Album();
            $this->storeAlbumData($request, $music, $validated, $allArtistIds);
            $url = route('albums.view', ['slug' => $music->slug]); // For an album

        }

    
    // Notify all subscribers
    $subscribers = Subscriber::all();
    foreach ($subscribers as $subscriber) {
        // Send the email immediately without queuing
        Mail::to($subscriber->email)->send(
            new NewReleaseNotification($request->type, $music->title, $url)
        );
    }
    
        
        return redirect()->route('music.index')->with('success', ucfirst($request->type) . ' uploaded successfully!');
    }
    

    private function storeSongData(Request $request, Song $music, $validated, $artistIds)
    {
        $music->title = $validated['title'];
        $music->release_date = $validated['release_date'] ?? null;
    
        // Generate slug
        $music->slug = Str::slug($validated['title']);
    
        // Upload cover art to public/uploads/covers
        if ($request->hasFile('cover_art')) {
            $cover = $request->file('cover_art');
            $coverFilename = Str::slug($validated['title']) . '-' . uniqid() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('uploads/covers'), $coverFilename);
            $music->cover_art = 'uploads/covers/' . $coverFilename;
        }
    
        // Upload audio file to public/uploads/audio
        if ($request->hasFile('audio_file')) {
            $audio = $request->file('audio_file');
            $audioFilename = Str::slug($validated['title']) . '-' . uniqid() . '.' . $audio->getClientOriginalExtension();
            $audio->move(public_path('uploads/audio'), $audioFilename);
            $music->file_path = 'uploads/audio/' . $audioFilename;
        }
    
        $music->save();
    
        // Attach artists
        $music->artists()->sync($artistIds);
    }
    
    
    
    private function storeAlbumData(Request $request, Album $music, $validated, $artistIds)
    {
        $music->title = $validated['title'];
        $music->release_date = $validated['release_date'] ?? null;
        $music->slug = Str::slug($validated['title']);
    
        // Upload cover image
        if ($request->hasFile('cover_art')) {
            $cover = $request->file('cover_art');
            $coverFilename = Str::slug($validated['title']) . '-' . uniqid() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('uploads/covers'), $coverFilename);
            $music->cover_image = 'uploads/covers/' . $coverFilename;
        }
    
        $music->save();
    
        // Attach artists to album
        $music->artists()->sync($artistIds);
    
        // Handle songs if provided
        if (isset($validated['songs']) && is_array($validated['songs'])) {
            foreach ($validated['songs'] as $index => $songData) {
                $song = new Song();
                $song->title = $songData['title'];
                $song->album_id = $music->id;
                $song->slug = Str::slug($songData['title']) . '-' . uniqid();
    
                // Handle audio upload
                $audioKey = 'songs.' . $index . '.audio_file';
                if ($request->hasFile($audioKey)) {
                    $audioFile = $request->file($audioKey);
                    $audioFilename = Str::slug($songData['title']) . '-' . uniqid() . '.' . $audioFile->getClientOriginalExtension();
                    $audioFile->move(public_path('uploads/audio'), $audioFilename);
                    $song->file_path = 'uploads/audio/' . $audioFilename;
                }
    
                $song->save();
    
                // Attach artists to the song
                $song->artists()->sync($artistIds);
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
    
        return view('pages.admin.music.album', compact('album'));
    }
    public function edit($id)
    {
        // Find the music item, either as a song or album
        $music = Song::find($id) ?? Album::find($id);
        
        // If songs is null, default it to an empty collection
        if ($music && !$music->songs) {
            $music->songs = collect();
        }
            
        if (!$music) {
            abort(404); // If neither is found, abort with 404
        }
    
        // Get all artists
        $artists = Artist::all();
    
        // Pass music (song or album), and artists to the view
        return view('pages.admin.music.edit', compact('music', 'artists'));
    }
    
    // Update a song or album
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist_ids' => 'nullable|array',
            'artist_ids.*' => 'exists:artists,id',
            'cover_art' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'release_date' => 'nullable|date',
        ]);
    
        // Find the Song or Album model (depending on what you're updating)
        $music = Song::findOrFail($id); // Use Album::findOrFail() for updating albums
    
        // Update basic fields
        $music->title = $request->title;
        $music->release_date = $request->release_date;
    
        // Handle the relationship with artists (Many-to-many relationship)
        if ($request->has('artist_ids')) {
            $music->artists()->sync($request->artist_ids); // Sync the artists to the song/album
        }
    
        // Handle the cover art upload (delete old cover art if exists)
        if ($request->hasFile('cover_art')) {
            // Delete the old cover art if it exists
            if ($music->cover_art) {
                Storage::delete($music->cover_art);
            }
            // Store the new cover art and update the model
            $music->cover_art = $request->file('cover_art')->store('cover_arts');
        }
    
        // Save the updated model
        $music->save();
    
        // Redirect back with a success message
        return redirect()->route('music.index')->with('success', 'Song/Album updated successfully!');
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
