<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     *
     * Fillable fields for a post.
     */
    protected $fillable = [
        'title',
        'content',
        'image_url',
    ];
}
