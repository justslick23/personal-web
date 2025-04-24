<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return view('pages.admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        return view('pages.admin.portfolio.create');
    }
    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'link' => 'nullable|url',
        ]);
    
        // Handle the image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            // Store the image in storage/app/public/images/portfolio with a unique name
            $imageName = $request->file('image')->store('images/portfolio', 'public');
        }
    
        // Store the portfolio item in the database
        Portfolio::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'category' => $validatedData['category'] ?? null,
            'image' => $imageName ?? null,
            'link' => $validatedData['link'] ?? null,
        ]);
    
        // Redirect back to the portfolio index with a success message
        return redirect()->route('portfolio.index')->with('success', 'Portfolio item added successfully!');
    }
    
    
}

