<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'intro',
        'description',
        'target_amount',
        'funded_amount',
        'start_date',
        'end_date',
        'cover_image_path',
    ];

    public function getEndDateByFormat($format)
    {
        return \DateTime::createFromFormat($format, $this->end_date);
    }

    public function getStartDateByFormat($format)
    {
        $start_date = \DateTime::createFromFormat($format, $this->start_date);
        
        return  $start_date;
    }
}
