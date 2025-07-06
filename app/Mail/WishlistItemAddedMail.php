<?php
namespace App\Mail;

use App\Models\WishlistItem;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WishlistItemAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    public $subscriber;

    public function __construct(WishlistItem $item, $subscriber)
    {
        $this->item = $item;
        $this->subscriber = $subscriber;
    }

    public function build()
    {
        $name = trim(($this->subscriber->first_name ?? '') . ' ' . ($this->subscriber->last_name ?? ''));
    
        return $this->subject('New Wishlist Item Added')
                    ->view('emails.wishlist.item_added')
                    ->with([
                        'item' => $this->item,
                        'name' => $name ?: 'there',
                    ]);
    }
    
}
