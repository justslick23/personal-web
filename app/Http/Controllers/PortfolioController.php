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
            $portfolioItems = Portfolio::where('is_active', true)
                ->latest()
                ->paginate(12);
            
            $categories = Portfolio::where('is_active', true)
                ->distinct()
                ->pluck('category')
                ->filter()
                ->values();
            
            return view('portfolio', compact('portfolioItems', 'categories'));
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
    
            // Handle image upload to storage
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
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
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

            $imagePath = $portfolio->image; // Keep existing image
            $oldImagePath = $portfolio->image; // Store for potential cleanup

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
     * Handle image upload with optimization using Laravel Storage
     */
    private function handleImageUpload($file)
    {
        if (!$file || !$file->isValid()) {
            throw new \Exception('Invalid file provided for upload');
        }

        try {
            // Generate unique filename
            $filename = 'portfolio/' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Check if Intervention Image is available for optimization
            if (class_exists('\Intervention\Image\Facades\Image')) {
                $optimizedImage = $this->optimizeImage($file);
                
                // Store optimized image using Laravel Storage
                $path = Storage::disk('public')->put($filename, $optimizedImage);
                
                Log::info('Optimized image uploaded successfully', ['filename' => $filename]);
            } else {
                // Fallback to regular storage
                $path = $file->storeAs('portfolio', basename($filename), 'public');
                
                Log::info('Image uploaded successfully', ['filename' => $filename]);
            }
            
            return $path;
            
        } catch (Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());
            throw new \Exception('Failed to process image upload: ' . $e->getMessage());
        }
    }

    /**
     * Optimize image using Intervention Image
     */
    private function optimizeImage($file)
    {
        $image = Image::make($file->getRealPath());
        
        // Auto-orient image based on EXIF data
        $image->orientate();
        
        // Resize if too large (maintain aspect ratio)
        if ($image->width() > 1920 || $image->height() > 1080) {
            $image->resize(1920, 1080, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        
        // Optimize quality based on file size
        $quality = $image->filesize() > 1000000 ? 75 : 85;
        
        // Return optimized image data
        return $image->encode($file->getClientOriginalExtension(), $quality)->__toString();
    }

    /**
     * Delete image from storage
     */
    private function deleteImage($imagePath)
    {
        try {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
                Log::info('Image deleted successfully', ['path' => $imagePath]);
            }
        } catch (Exception $e) {
            Log::warning('Failed to delete image: ' . $e->getMessage(), ['path' => $imagePath]);
        }
    }

    /**
     * Get optimized image URL with fallback
     */
    public static function getImageUrl($portfolio, $default = 'images/default-portfolio.jpg')
    {
        if (!$portfolio || !$portfolio->image) {
            return asset($default);
        }

        // Check if image exists in storage
        if (Storage::disk('public')->exists($portfolio->image)) {
            return Storage::url($portfolio->image);
        }

        return asset($default);
    }

    /**
     * Get portfolio statistics for dashboard
     */
    public function getStats()
    {
        try {
            return [
                'total' => Portfolio::count(),
                'active' => Portfolio::where('is_active', true)->count(),
                'featured' => Portfolio::where('featured', true)->count(),
                'categories' => Portfolio::distinct()->count('category'),
                'recent' => Portfolio::where('created_at', '>=', now()->subDays(7))->count(),
            ];
        } catch (Exception $e) {
            Log::error('Error getting portfolio stats: ' . $e->getMessage());
            return [
                'total' => 0,
                'active' => 0, 
                'featured' => 0,
                'categories' => 0,
                'recent' => 0,
            ];
        }
    }

    /**
     * Test storage setup and permissions
     */
    public function testStorage()
    {
        try {
            // Test if we can create and delete files in public storage
            $testFilename = 'portfolio/storage_test_' . time() . '.txt';
            $testContent = 'Storage test: ' . now();
            
            // Try to store file
            $stored = Storage::disk('public')->put($testFilename, $testContent);
            
            if (!$stored) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot store files in public disk'
                ], 500);
            }
            
            // Check if file exists
            if (!Storage::disk('public')->exists($testFilename)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'File was not created successfully'
                ], 500);
            }
            
            // Get file info
            $size = Storage::disk('public')->size($testFilename);
            $url = Storage::url($testFilename);
            
            // Cleanup
            Storage::disk('public')->delete($testFilename);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Storage is working correctly!',
                'details' => [
                    'disk' => 'public',
                    'path' => Storage::disk('public')->path(''),
                    'url_base' => Storage::url(''),
                    'test_file_size' => $size . ' bytes',
                    'test_url' => $url,
                    'storage_link_exists' => is_link(public_path('storage'))
                ]
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Storage test failed: ' . $e->getMessage()
            ], 500);
        }
    }
}