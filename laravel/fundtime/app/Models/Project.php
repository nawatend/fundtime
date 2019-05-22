<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'description',
        'target_amount',
        'funded_amount',
        'start_date',
        'end_date',
        'cover_image_path',
    ];
}
