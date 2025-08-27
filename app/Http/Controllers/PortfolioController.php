<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    public function index()
    {
        try {
            $portfolios = Portfolio::latest()->get();
            return view('pages.admin.portfolio.index', compact('portfolios'));
        } catch (Exception $e) {
            Log::error('Error fetching portfolios: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to load portfolios.');
        }
    }

    public function create()
    {
        return view('pages.admin.portfolio.create');
    }
    
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:2000',
                'category' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB limit
                'link' => 'nullable|url|max:500',
            ], [
                'title.required' => 'Portfolio title is required.',
                'category.required' => 'Please select a category.',
                'image.required' => 'Please upload an image.',
                'image.image' => 'The uploaded file must be an image.',
                'image.max' => 'Image size cannot exceed 2MB.',
                'link.url' => 'Please provide a valid URL.',
            ]);
    
            // Handle image upload locally
            $imagePath = $this->handleImageUpload($request->file('image'));
    
            // Save portfolio data in DB with local image path
            $portfolio = Portfolio::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'category' => $validatedData['category'],
                'image' => $imagePath,
                'link' => $validatedData['link'],
            ]);
    
            Log::info('Portfolio item created successfully', ['id' => $portfolio->id]);
    
            return redirect()->route('portfolio.index')
                ->with('success', 'Portfolio item added successfully!');
    
        } catch (Exception $e) {
            Log::error('Error creating portfolio item: ' . $e->getMessage());
    
            // Clean up the uploaded file if it exists locally
            if (isset($imagePath) && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
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
        return view('pages.admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:2000',
                'category' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'link' => 'nullable|url|max:500',
            ]);

            $imagePath = $portfolio->image; // Keep existing image by default

            // Handle new image upload
            if ($request->hasFile('image')) {
                // Delete old image from public directory
                if ($portfolio->image && file_exists(public_path($portfolio->image))) {
                    unlink(public_path($portfolio->image));
                }
                
                $imagePath = $this->handleImageUpload($request->file('image'));
            }

            $portfolio->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'category' => $validatedData['category'],
                'image' => $imagePath,
                'link' => $validatedData['link'],
            ]);

            Log::info('Portfolio item updated successfully', ['id' => $portfolio->id]);

            return redirect()->route('portfolio.index')
                ->with('success', 'Portfolio item updated successfully!');

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
            // Delete image from public directory
            if ($portfolio->image && file_exists(public_path($portfolio->image))) {
                unlink(public_path($portfolio->image));
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
     * Handle image upload to local public directory with compression
     */
    public function handleImageUpload($file)
    {
        if (!$file) {
            throw new \Exception('No file provided for upload');
        }

        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        // Define destination path in public directory
        $destinationPath = public_path('images/portfolio');
        
        // Create directory if it doesn't exist
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Full path for the file
        $fullPath = $destinationPath . '/' . $filename;
        
        try {
            // Use Intervention Image for compression and resizing
            $image = Image::make($file->getRealPath());
            
            // Resize if image is too large (max width: 1200px, maintain aspect ratio)
            if ($image->width() > 1200) {
                $image->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }
            
            // Compress and save
            $image->save($fullPath, 85); // 85% quality
            
        } catch (Exception $e) {
            // Fallback to regular move if Intervention Image fails
            Log::warning('Image compression failed, using regular upload: ' . $e->getMessage());
            $file->move($destinationPath, $filename);
        }

        // Return relative path for database storage
        return 'images/portfolio/' . $filename;
    }
    
    /**
     * Get public URL for portfolio image
     */
    public function getImageUrl(Portfolio $portfolio)
    {
        if (!$portfolio->image) {
            return asset('images/default-portfolio.jpg'); // Fallback image
        }

        return asset($portfolio->image);
    }

    /**
     * Test local storage setup
     */
    public function testLocalStorage()
    {
        try {
            $testPath = public_path('images/portfolio');
            
            // Check if directory exists and is writable
            if (!file_exists($testPath)) {
                mkdir($testPath, 0755, true);
            }
            
            if (!is_writable($testPath)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Portfolio images directory is not writable',
                    'path' => $testPath,
                    'permissions' => substr(sprintf('%o', fileperms($testPath)), -4)
                ]);
            }
            
            // Test file creation
            $testFile = $testPath . '/test-' . time() . '.txt';
            file_put_contents($testFile, 'Local storage test successful at ' . now());
            
            if (!file_exists($testFile)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create test file',
                    'path' => $testPath
                ]);
            }
            
            // Clean up test file
            unlink($testFile);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Local storage is working correctly!',
                'path' => $testPath,
                'permissions' => substr(sprintf('%o', fileperms($testPath)), -4),
                'writable' => is_writable($testPath),
                'url_base' => asset('images/portfolio/')
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Local storage test failed',
                'error' => $e->getMessage(),
                'path' => $testPath ?? 'Unknown'
            ]);
        }
    }
}