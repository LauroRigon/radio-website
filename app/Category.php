<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function posts() {
        return $this->hasMany('App\Post')->orderBy('published_at', 'desc');
    }

    public function getCreatedAtAttribute($value)
    {
        if($value) {
            $date = date_create($value);

            return date_format($date, 'd-m-Y');
        }
    }
}
