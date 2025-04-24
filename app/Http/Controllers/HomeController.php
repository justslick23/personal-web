<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Song;

use App\Models\Album;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted; // Create a Mailable for contact form
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
        $portfolioItems = Portfolio::all(); // You can filter or paginate as needed

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
        $albums = Album::with('songs')->get();
        $songs = Song::with('album')->get();
    
        return view('pages.music.index', compact('albums', 'songs'));
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
    
    
    public function trackPlay($slug)
    {
        $track = Song::where('slug', $slug)->first() ?? Album::where('slug', $slug)->first();
    
        if ($track) {
            // Increment play count
            $track->statistics()->increment('plays');
        }
    
        return response()->json(['status' => 'success']);
    }
    

    
    
    private function incrementTrackStatistic($track, $type)
{
    // Get or create the statistics record for the track
    $statistics = $track->statistics()->firstOrCreate(['song_id' => $track->id]);

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

public function downloadTrack($id)
{
    // Find song or album by ID
    $track = Song::find($id) ?? Album::find($id);

    if (!$track || !$track->file_path) {
        // If no track or file_path exists, return a 404 error
        abort(404);
    }

    // Increment download counter
    $this->incrementTrackStatistic($track, 'downloads');

    // Check if the file exists before attempting to download
    $filePath = storage_path('app/public/' . $track->file_path);
    if (!file_exists($filePath)) {
        // If the file does not exist, return a 404 error
        abort(404);
    }

    // Set MIME type for MP3 files
    $mimeType = 'audio/mpeg';

    // Return the MP3 file for download with correct MIME type
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
        // Validation for contact form fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Send email to admin or specified email
        Mail::to('hello@tokelofoso.online')->send(new ContactFormSubmitted($validated));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent!');
    }


    
    

}
