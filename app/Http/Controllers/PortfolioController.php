<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortfolioItem;

class PortfolioController extends Controller
{
    public function index()
    {
        $works = PortfolioItem::orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        $categoryCounts = [
            'All'            => $works->count(),
            'Graphic Design' => $works->where('category', 'Graphic Design')->count(),
            'Software Dev'   => $works->where('category', 'Software Dev')->count(),
        ];

        return view('portfolio', compact('works', 'categoryCounts'));
    }

    /**
     * Single project page.
     * Uncomment and expand once you add slug + detail views.
     */
    public function show(string $slug)
    {
        abort(404); // placeholder until detail view exists
    }
}