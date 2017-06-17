<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programming extends Model
{
    protected $table = 'programming';
    protected $fillable = ['name', 'type', 'day_of_week','time'];
}
