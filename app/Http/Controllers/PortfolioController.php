<?php

namespace App\Http\Controllers;
use Spatie\ImageOptimizer\OptimizerChainFactory;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;
use Aws\S3\Exception\S3Exception; // Ensure S3Exception is imported for specific errors
use Illuminate\Support\Str; // Add this at the top if not already there
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
    
            // Compress and store the image locally (default disk)
            $imagePath = $this->handleImageUpload($request->file('image'));
    
            // Save portfolio data in DB with local image path
            $portfolio = Portfolio::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'category' => $validatedData['category'],
                'image' => $imagePath,
                'link' => $validatedData['link'],
            ]);
    
            \Log::info('Portfolio item created successfully', ['id' => $portfolio->id]);
    
            return redirect()->route('portfolio.index')
                ->with('success', 'Portfolio item added successfully!');
    
        } catch (Exception $e) {
            \Log::error('Error creating portfolio item: ' . $e->getMessage());
    
            // Clean up the uploaded file if it exists locally
            if (isset($imagePath) && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
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
                // Delete old image
                if ($portfolio->image && Storage::disk('b2')->exists($portfolio->image)) {
                    Storage::disk('b2')->delete($portfolio->image);
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
            // Delete image from B2 storage
            if ($portfolio->image && Storage::disk('b2')->exists($portfolio->image)) {
                Storage::disk('b2')->delete($portfolio->image);
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
    * Handle image upload to Backblaze B2 with enhanced error handling
    */
    public function handleImageUpload($file)
{
    if (!$file) {
        throw new \Exception('No file provided for upload');
    }

    // Generate unique filename
    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    $targetPath = 'images/portfolio/' . $filename;

    // Save original file temporarily
    $tempPath = $file->getRealPath();

    // You can also move the uploaded file to a temp location first, but here we optimize directly

    // Create the optimizer chain
    $optimizerChain = OptimizerChainFactory::create();

    // Optimize the image in-place
    $optimizerChain->optimize($tempPath);

    // Store optimized image to disk
    $stored = Storage::disk('public')->putFileAs('images/portfolio', $file, $filename);

    if (!$stored) {
        throw new \Exception('Failed to store optimized image');
    }

    // Return stored file path (relative)
    return $targetPath;
}
    
    /**
     * Get signed URL for private portfolio image
     */
    public function getImageUrl(Portfolio $portfolio, $expiration = 3600)
    {
        if (!$portfolio->image) {
            return null;
        }

        // Generate signed URL for private B2 bucket (1 hour expiration by default)
        return Storage::disk('b2')->temporaryUrl($portfolio->image, now()->addSeconds($expiration));
    }

    /**
     * Serve portfolio image through Laravel (for private buckets)
     */
    public function serveImage(Portfolio $portfolio)
    {
        try {
            if (!$portfolio->image || !Storage::disk('b2')->exists($portfolio->image)) {
                abort(404, 'Image not found');
            }

            $file = Storage::disk('b2')->get($portfolio->image);
            $mimeType = Storage::disk('b2')->mimeType($portfolio->image);

            return response($file, 200)
                ->header('Content-Type', $mimeType)
                ->header('Cache-Control', 'public, max-age=3600'); // Cache for 1 hour

        } catch (Exception $e) {
            Log::error('Error serving portfolio image: ' . $e->getMessage());
            abort(404, 'Image not found');
        }
    }

    public function testB2Connection()
    {
        try {
            $config = config('filesystems.disks.b2');
    
            // Correct keys to check for S3 driver
            $requiredKeys = ['key', 'secret', 'region', 'bucket', 'endpoint'];
            $missing = [];
    
            foreach ($requiredKeys as $key) {
                // Check if the key exists and has a non-empty value
                if (!isset($config[$key]) || empty($config[$key])) {
                    $missing[] = $key;
                }
            }
    
            if (!empty($missing)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Missing B2 configuration',
                    'missing_keys' => $missing,
                    // Map values to 'SET' or 'MISSING' for display, handling null/empty for keys
                    'config_status' => array_map(fn ($k) => (isset($config[$k]) && !empty($config[$k])) ? 'SET' : 'MISSING', array_combine($requiredKeys, $requiredKeys)),
                    'provided_config' => $config // For more detailed debug, remove for production
                ]);
            }
    
            $disk = Storage::disk('b2');
            $testFile = 'debug/connection-test-' . Str::random(6) . '.txt';
    
            // Perform a write operation
            $disk->put($testFile, 'Backblaze B2 test successful at ' . now());
    
            // Perform a read operation to verify
            $content = $disk->get($testFile);
    
            // Clean up the test file
            $disk->delete($testFile);
    
            return response()->json([
                'status' => 'success',
                'message' => 'B2 connection working and file operations successful!',
                'test_file_path' => $testFile,
                'test_file_content_snippet' => substr($content, 0, 50) . '...',
                // If your bucket is public, you can try to get its URL for verification
                'public_url_attempt' => method_exists($disk, 'url') ? $disk->url($testFile) : 'No public URL method',
            ]);
        } catch (\Aws\S3\Exception\S3Exception $e) {
            // Catch specific S3 exceptions for more detail
            return response()->json([
                'status' => 'error',
                'message' => 'B2 connection failed with S3 Exception',
                'error_code' => $e->getAwsErrorCode(),
                'error_message' => $e->getAwsErrorMessage(),
                'request_id' => $e->getAwsRequestId(),
                'details' => $e->getMessage(),
                'config_status' => [
                    'key' => config('filesystems.disks.b2.key') ? 'Set' : 'Missing',
                    'secret' => config('filesystems.disks.b2.secret') ? 'Set' : 'Missing',
                    'bucket' => config('filesystems.disks.b2.bucket') ? 'Set' : 'Missing',
                    'region' => config('filesystems.disks.b2.region') ? 'Set' : 'Missing',
                    'endpoint' => config('filesystems.disks.b2.endpoint') ? 'Set' : 'Missing',
                ]
            ]);
        } catch (\Exception $e) {
            // Catch any other general exceptions
            return response()->json([
                'status' => 'error',
                'message' => 'B2 connection failed unexpectedly',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                 'config_status' => [
                    'key' => config('filesystems.disks.b2.key') ? 'Set' : 'Missing',
                    'secret' => config('filesystems.disks.b2.secret') ? 'Set' : 'Missing',
                    'bucket' => config('filesystems.disks.b2.bucket') ? 'Set' : 'Missing',
                    'region' => config('filesystems.disks.b2.region') ? 'Set' : 'Missing',
                    'endpoint' => config('filesystems.disks.b2.endpoint') ? 'Set' : 'Missing',
                ]
            ]);
        }
    }
}