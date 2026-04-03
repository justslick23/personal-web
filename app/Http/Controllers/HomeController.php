<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortfolioItem;

class HomeController extends Controller
{
    /**
     * Render the home / landing page.
     * Passes the latest 6 portfolio items to the view.
     */
    public function index()
    {
        $portfolioItems = PortfolioItem::orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('index', compact('portfolioItems'));
    }

    /**
     * Stream the CV file as a download.
     * Place your CV at:  public/files/tokelo-foso-cv.pdf
     */
    public function downloadCv()
    {
        $path = public_path('files/tokelo-foso-cv.pdf');

        if (! file_exists($path)) {
            abort(404, 'CV not found.');
        }

        return response()->download($path, 'Tokelo-Foso-CV.pdf');
    }
}