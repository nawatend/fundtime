<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backer extends Model
{
    protected $table = 'backers';

    protected $fillable = [
        'project_id',
        'user_id',
        'pledge_id',
    ];
}
