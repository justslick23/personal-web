<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
    {        $projects = Portfolio::all();

        return view('pages.portfolio', compact('projects'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    // Music routes
    public function music()
    {
        $tracks = collect([
            (object)[
                'id' => 1,
                'title' => 'Skyline Drift',
                'artist' => 'Just Slick',
                'cover_url' => 'https://via.placeholder.com/400x400?text=Skyline+Drift',
            ],
            (object)[
                'id' => 2,
                'title' => 'Ocean Flow',
                'artist' => 'Just Slick',
                'cover_url' => 'https://via.placeholder.com/400x400?text=Ocean+Flow',
            ],
            (object)[
                'id' => 3,
                'title' => 'Night Drive',
                'artist' => 'Just Slick',
                'cover_url' => 'https://via.placeholder.com/400x400?text=Night+Drive',
            ],
            (object)[
                'id' => 4,
                'title' => 'Electric Soul',
                'artist' => 'Just Slick',
                'cover_url' => 'https://via.placeholder.com/400x400?text=Electric+Soul',
            ],
        ]);

        return view('pages.music.index', compact('tracks'));
    }

    public function musicShow($id)
    {
        $track = [
            'id' => $id,
            'title' => 'Skyline Drift',
            'artist' => 'Just Slick',
            'cover' => 'cover1.jpg',
            'year' => 2023,
            'genre' => 'Hip-Hop',
            'audio' => 'sample-track.mp3',
        ];

        return view('pages.music.show', compact('track'));
    }
}
