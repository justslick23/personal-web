<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistEmail extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'is_active'];
}
