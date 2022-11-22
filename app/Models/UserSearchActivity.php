<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSearchActivity extends Model
{
    use HasFactory;

    /**
     *
     * Fillable fields for a user search activity.
     */
    protected $fillable = [
        'user_id',
        'search_term',
        'results_count',
    ];
}
