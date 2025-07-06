<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WishlistItem;
use Illuminate\Support\Facades\Storage;
use App\Mail\WishlistItemAddedMail;
use App\Models\WishlistEmail;
use Illuminate\Support\Facades\Mail;
class WishlistController extends Controller
{
    // Show wishlist to public (friends)
    public function showPublic()
    {
        $items = WishlistItem::all();
        return view('wishlist.public', compact('items'));
    }

    // Admin panel view
    public function indexAdmin()
    {
        $items = WishlistItem::all();
        return view('wishlist.admin', compact('items'));
    }

    // Store new item
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'contribution_link' => 'nullable|url',
        ]);
    
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('wishlist_images', 'public');
        }
    
        // Set default contribution link if none provided
        if (empty($validated['contribution_link'])) {
            $validated['contribution_link'] = 'https://paypal.me/JustSlick?country.x=LS&locale.x=en_US';
        }
    
        // Create the wishlist item
        $item = WishlistItem::create($validated);
    
        // Fetch all active subscribers
        $subscribers = WishlistEmail::where('is_active', true)->get();
    
        // Send notification email to each subscriber
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)
                ->send(new WishlistItemAddedMail($item, $subscriber));
        }
    
        return redirect()->back()->with('success', 'Item added successfully.');
    }

    // Show item edit form
    public function edit($id)
    {
        $item = WishlistItem::findOrFail($id);
        return view('wishlist.edit', compact('item'));
    }

    // Update item
    public function update(Request $request, $id)
    {
        $item = WishlistItem::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'contribution_link' => 'nullable|url',
            'is_received' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $validated['image'] = $request->file('image')->store('wishlist_images', 'public');
        }

        $item->update($validated);
        return redirect()->route('wishlist.admin')->with('success', 'Item updated successfully.');
    }

    // Delete item
    public function destroy($id)
    {
        $item = WishlistItem::findOrFail($id);

        // Delete image
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();
        return redirect()->back()->with('success', 'Item deleted.');
    }

    // Toggle received status
    public function toggleReceived($id)
    {
        $item = WishlistItem::findOrFail($id);
        $item->is_received = !$item->is_received;
        $item->save();

        return redirect()->back()->with('success', 'Received status updated.');
    }

    public function listSubscribers()
    {
        $subscribers = WishlistEmail::orderBy('created_at', 'desc')->paginate(15);
        return view('wishlist_emails.index', compact('subscribers'));
    }

    // Show form to add subscriber
    public function createSubscriber()
    {
        return view('wishlist_emails.create');
    }

    // Store new subscriber
    public function storeSubscriber(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:wishlist_emails,email',
        ]);

        WishlistEmail::create($validated);

        return redirect()->route('wishlistEmails.index')->with('success', 'Subscriber added successfully.');
    }

    // Delete subscriber
    public function destroySubscriber($id)
    {
        $subscriber = WishlistEmail::findOrFail($id);
        $subscriber->delete();

        return redirect()->back()->with('success', 'Subscriber deleted.');
    }
}