<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_master'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getCreatedAtAttribute($value)
    {
        if($value) {
            $date = date_create($value);

            return date_format($date, 'd-m-Y');
        }
    }

    public function getIsMasterAttribute($value)
    {
        return ($value == 1)? 'Sim': 'Não';
    }
}
