<?php

namespace App\Http\Controllers;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Song;
use Illuminate\Support\Str;

use App\Models\Album;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted; // Create a Mailable for contact form
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    public function index()
    {
        $portfolioItems = Portfolio::paginate(6); // You can filter or paginate as needed

        return view('pages.home', compact('portfolioItems'));
    }

    // Static pages routes
    public function about()
    {
        return view('pages.about');
    }

    
    public function portfolio()
    {        $projects = Portfolio::paginate(6);

        return view('pages.portfolio', compact('projects'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    // Music routes
    public function music()
    {
        $albums = Album::with('songs')->orderBy('release_date', 'desc')->get();
        $songs = Song::with('album')->whereNull('album_id')->orderBy('release_date', 'desc')->get();
    
        return view('pages.music.index', compact('albums', 'songs'));
    }

    public function downloadAlbum($slug)
{
    $album = Album::with('songs')->where('slug', $slug)->firstOrFail();

    $zip = new \ZipArchive();
    $zipFileName = Str::slug($album->title) . '.zip';
    $zipPath = storage_path('app/public/zips/' . $zipFileName);

    if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
        foreach ($album->songs as $song) {
            if ($song->file_path && file_exists(storage_path('app/public/' . $song->file_path))) {
                $zip->addFile(
                    storage_path('app/public/' . $song->file_path),
                    basename($song->file_path)
                );
            }
        }
        $zip->close();
    }

    // ✅ Increment album download count
    $album->increment('downloads');

    return response()->download($zipPath)->deleteFileAfterSend(true);
}

    public function musicShow($slug)
    {
        // Find song or album by slug
        $track = Song::where('slug', $slug)->first() ?? Album::where('slug', $slug)->first();
    
        if (!$track) {
            abort(404);
        }
    
        // Track views
        $this->incrementTrackStatistic($track, 'views');
    
        return view('pages.music.show', compact('track'));
    }

    public function showAlbum($slug)
    {
        $album = Album::with('songs.songStatistics', 'artists') // Eager load song statistics
                      ->where('slug', $slug)
                      ->firstOrFail();
    
        return view('pages.music.album', compact('album'));
    }
    
    
    public function trackPlay($id)
{
    // Find the song with its album (if any)
    $song = Song::with('album')->findOrFail($id);

    // Ensure the song has statistics and increment the play count
    $songStatistics = $song->songStatistics ?? $song->songStatistics()->create(); // Create if no stats exist
    $songStatistics->increment('plays');
    
    // Increment album streams only if the song has an associated album
    if ($song->album) {
        $song->album->increment('streams');
    } else {
        // Handle case where song has no album (optional logging or tracking here)
        // Log::info("Song {$song->id} has no album, skipping album stream increment.");
    }

    // Return response
    return response()->json(['message' => 'Play recorded']);
}

    
    

    
    
private function incrementTrackStatistic($track, $type)
{
    $statistics = $track->songStatistics()->firstOrCreate(['song_id' => $track->id]);

    match ($type) {
        'views' => $statistics->increment('views'),
        'downloads' => $statistics->increment('downloads'),
        'plays' => $statistics->increment('plays'),
        default => null,
    };
}

public function downloadTrack($slug)
{
    $track = Song::where('slug', $slug)->first() 
             ?? Album::where('slug', $slug)->first();

    if (!$track || !$track->file_path) {
        abort(404, 'Track not found or file path missing.');
    }

    $this->incrementTrackStatistic($track, 'downloads');

    $filePath = public_path($track->file_path);

    if (!file_exists($filePath)) {
        abort(404, 'File does not exist.');
    }

    return response()->download($filePath, $track->title . '.mp3', [
        'Content-Type' => 'audio/mpeg',
    ]);
}



// Helper function to get MIME type based on file extension
private function getMimeType($extension)
{
    $mimeTypes = [
        'mp3' => 'audio/mpeg',
        'wav' => 'audio/wav',
        'ogg' => 'audio/ogg',
        // Add more file types if needed
    ];

    return $mimeTypes[$extension] ?? 'application/octet-stream'; // Default to binary stream
}


public function submit(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string|max:1000',
    ]);

    try {
        Mail::to('hello@tokelofoso.online')->send(new ContactFormSubmitted($validated));
        return redirect()->back()->with('success', 'Your message has been sent!');
    } catch (\Exception $e) {
        Log::error('Contact form mail failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to send message. Please try again later.');
    }
}


    
    

}
