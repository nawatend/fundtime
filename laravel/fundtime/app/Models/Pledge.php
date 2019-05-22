<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pledge extends Model
{
    protected $table = 'pledges';

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'price',
        'slug',
    ];
}
