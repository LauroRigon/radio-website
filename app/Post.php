<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Post extends Model
{
    protected $fillable = ['title', 'subtitle', 'slug', 'content', 'category_id', 'user_id', 'thumbnail', 'is_about'];

    public function galleries() {
        return $this->hasMany('App\Gallery');
    }

    public function user(){
        return $this->belongsTo('App\User')->get()[0];
    }

    //MUTATORS

    public function getCategoryIdAttribute($value) {
        return Category::find($value)->name;
    }

    public function getPublishedAtAttribute($value) {
        if($value) {
            $date = date_create($value);

            return date_format($date, 'd-m-Y / H:i:s');
        }else{
            return "Não publicado";
        }
    }

    public function getCreatedAtAttribute($value) {
        $date = date_create($value);

        return date_format($date, 'd-m-Y / H:i:s');
    }

    public function getUpdatedAtAttribute($value) {
        $date = date_create($value);

        return date_format($date, 'd-m-Y / H:i:s');
    }
}
