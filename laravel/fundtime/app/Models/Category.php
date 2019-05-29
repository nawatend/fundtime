<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'category_name',
        
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function getRouteKeyName()
    {
        return 'category_name';
    }
}
