<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Post extends Model
{
    protected $fillable = ['title', 'subtitle', 'content', 'category_id', 'user_id', 'thumbnail', 'is_about'];

    public function getCategoryIdAttribute($value)
    {
        return Category::find($value)->name;
    }

    public function getPublishedAtAttribute($value)
    {
        if($value) {
            $date = date_create($value);

            return date_format($date, 'd-m-Y / H:i:s');
        }else{
            return "Não publicado";
        }
    }
}
