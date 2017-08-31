<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class MusicOrder extends Model
{
    protected $fillable = ['name', 'content', 'user_order_ip', 'expires_date'];

    public function getCreatedAtAttribute($value)
    {
        $date = date_create($value);

        return date_format($date, 'Y-m-d H:i:s');
    }

    public function canSendOrder($request) {
        $lastUserOrder = $this->where('user_order_ip', $request->ip())->orderBy('created_at', 'desc')->first();

        if($lastUserOrder == null){
            return true;
        }

        $expires_date = Carbon::createFromFormat('Y-m-d H:i:s', $lastUserOrder->expires_date);

        return $expires_date->isPast();
    }
}
