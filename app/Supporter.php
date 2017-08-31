<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supporter extends Model
{
    public $fillable = ['name', 'image', 'status', 'link', 'side'];

}
