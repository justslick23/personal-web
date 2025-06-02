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
    // Get or create the statistics record for the track
    $statistics = $track->Songstatistics()->firstOrCreate(['song_id' => $track->id]);

    switch ($type) {
        case 'views':
            $statistics->increment('views');
            break;
        case 'downloads':
            $statistics->increment('downloads');
            break;
        case 'plays':
            $statistics->increment('plays');
            break;
    }

    $statistics->save();
}
public function downloadTrack($slug)
{
    // Try to find the song by slug
    $track = Song::where('slug', $slug)->first();

    // If not found as a song, try finding it as an album
    if (!$track) {
        $track = Album::where('slug', $slug)->first();
    }

    // If still not found or no file path available, abort
    if (!$track || !$track->file_path) {
        abort(404, 'Track not found or file path missing.');
    }

    // Increment download counter
    $this->incrementTrackStatistic($track, 'downloads');

    // Construct full path to file
    $filePath = public_path($track->file_path);

    if (!file_exists($filePath)) {
        abort(404, 'File does not exist.');
    }

    // Determine MIME type (can be extended later if needed)
    $mimeType = 'audio/mpeg';

    // Return the file for download
    return response()->download($filePath, null, ['Content-Type' => $mimeType]);
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
