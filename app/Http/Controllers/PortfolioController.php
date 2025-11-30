<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    /**
     * Display portfolio items for public view
     */
    public function publicIndex()
    {
        try {
            $portfolioItems = Portfolio::where('is_active', true)
                ->latest()
                ->take(6)
                ->get();
            
            return view('welcome', compact('portfolioItems'));
        } catch (Exception $e) {
            Log::error('Error fetching public portfolios: ' . $e->getMessage());
            $portfolioItems = collect();
            return view('welcome', compact('portfolioItems'));
        }
    }

    /**
     * Display all portfolio items for public portfolio page
     */
    public function portfolioPage()
    {
        try {
            $projects = Portfolio::where('is_active', true)
                ->latest()
                ->paginate(12);
            
            $categories = Portfolio::where('is_active', true)
                ->distinct()
                ->pluck('category')
                ->filter()
                ->values();
            
            return view('pages.portfolio', compact('projects', 'categories'));
        } catch (Exception $e) {
            Log::error('Error fetching portfolio page: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Unable to load portfolio.');
        }
    }

    /**
     * Admin index
     */
    public function index()
    {
        try {
            $portfolios = Portfolio::latest()->paginate(12);
            return view('pages.admin.portfolio.index', compact('portfolios'));
        } catch (Exception $e) {
            Log::error('Error fetching portfolios: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to load portfolios.');
        }
    }

    public function create()
    {
        $categories = [
            'Web App Design',
            'Poster Design', 
            'Branding',
            'UI/UX Design',
            'Mobile App Design',
            'Logo Design',
            'Print Design'
        ];
        
        return view('pages.admin.portfolio.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:2000',
                'category' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'link' => 'nullable|url|max:500',
                'is_active' => 'boolean',
                'featured' => 'boolean',
            ], [
                'title.required' => 'Portfolio title is required.',
                'category.required' => 'Please select a category.',
                'image.required' => 'Please upload an image.',
                'image.image' => 'The uploaded file must be an image.',
                'image.max' => 'Image size cannot exceed 5MB.',
                'link.url' => 'Please provide a valid URL.',
            ]);
    
            // Handle image upload - USING PUBLIC/IMAGES FOLDER
            $imagePath = $this->handleImageUpload($request->file('image'));
    
            // Create portfolio item
            $portfolio = Portfolio::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'category' => $validatedData['category'],
                'image' => $imagePath,
                'link' => $validatedData['link'],
                'is_active' => $request->boolean('is_active', true),
                'featured' => $request->boolean('featured', false),
                'slug' => Str::slug($validatedData['title']),
            ]);
    
            Log::info('Portfolio item created successfully', ['id' => $portfolio->id]);
    
            return redirect()->route('portfolio.index')
                ->with('success', 'Portfolio item added successfully!');
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (Exception $e) {
            Log::error('Error creating portfolio item: ' . $e->getMessage());
    
            // Clean up uploaded file on error
            if (isset($imagePath)) {
                $this->deleteImage($imagePath);
            }
    
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create portfolio item. Please try again.');
        }
    }

    public function show(Portfolio $portfolio)
    {
        return view('pages.admin.portfolio.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        $categories = [
            'Web App Design',
            'Poster Design', 
            'Branding',
            'UI/UX Design',
            'Mobile App Design',
            'Logo Design',
            'Print Design'
        ];
        
        return view('pages.admin.portfolio.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:2000',
                'category' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'link' => 'nullable|url|max:500',
                'is_active' => 'boolean',
                'featured' => 'boolean',
            ]);

            $imagePath = $portfolio->image;
            $oldImagePath = $portfolio->image;

            // Handle new image upload
            if ($request->hasFile('image')) {
                $imagePath = $this->handleImageUpload($request->file('image'));
            }

            // Update portfolio
            $portfolio->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'category' => $validatedData['category'],
                'image' => $imagePath,
                'link' => $validatedData['link'],
                'is_active' => $request->boolean('is_active', $portfolio->is_active),
                'featured' => $request->boolean('featured', $portfolio->featured),
                'slug' => Str::slug($validatedData['title']),
            ]);

            // Delete old image if new one was uploaded
            if ($request->hasFile('image') && $oldImagePath && $oldImagePath !== $imagePath) {
                $this->deleteImage($oldImagePath);
            }

            Log::info('Portfolio item updated successfully', ['id' => $portfolio->id]);

            return redirect()->route('portfolio.index')
                ->with('success', 'Portfolio item updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (Exception $e) {
            Log::error('Error updating portfolio item: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update portfolio item. Please try again.');
        }
    }

    public function destroy(Portfolio $portfolio)
    {
        try {
            // Delete associated image
            if ($portfolio->image) {
                $this->deleteImage($portfolio->image);
            }

            $portfolio->delete();

            Log::info('Portfolio item deleted successfully', ['id' => $portfolio->id]);

            return redirect()->route('portfolio.index')
                ->with('success', 'Portfolio item deleted successfully!');

        } catch (Exception $e) {
            Log::error('Error deleting portfolio item: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to delete portfolio item. Please try again.');
        }
    }

    /**
     * Toggle portfolio item active status
     */
    public function toggleStatus(Portfolio $portfolio)
    {
        try {
            $portfolio->update([
                'is_active' => !$portfolio->is_active
            ]);

            $status = $portfolio->is_active ? 'activated' : 'deactivated';
            
            return redirect()->back()
                ->with('success', "Portfolio item {$status} successfully!");

        } catch (Exception $e) {
            Log::error('Error toggling portfolio status: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to update status. Please try again.');
        }
    }

    /**
     * Handle image upload to public/images/portfolio folder
     */
    private function handleImageUpload($file)
    {
        if (!$file || !$file->isValid()) {
            throw new \Exception('Invalid file provided for upload');
        }

        try {
            // Create portfolio directory if it doesn't exist
            $uploadPath = public_path('images/portfolio');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Generate unique filename
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            
            // Move file to public/images/portfolio
            $file->move($uploadPath, $filename);
            
            // Return relative path for database storage
            $relativePath = 'images/portfolio/' . $filename;
            
            Log::info('Image uploaded successfully', ['path' => $relativePath]);
            
            return $relativePath;
            
        } catch (Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());
            throw new \Exception('Failed to process image upload: ' . $e->getMessage());
        }
    }

    /**
     * Delete image from public/images/portfolio folder
     */
    private function deleteImage($imagePath)
    {
        try {
            if ($imagePath) {
                $fullPath = public_path($imagePath);
                if (File::exists($fullPath)) {
                    File::delete($fullPath);
                    Log::info('Image deleted successfully', ['path' => $imagePath]);
                }
            }
        } catch (Exception $e) {
            Log::warning('Failed to delete image: ' . $e->getMessage(), ['path' => $imagePath]);
        }
    }
}