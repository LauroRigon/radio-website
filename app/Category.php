<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function getCreatedAtAttribute($value)
    {
        if($value) {
            $date = date_create($value);

            return date_format($date, 'd-m-Y');
        }
    }
}
