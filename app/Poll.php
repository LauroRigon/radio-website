<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Poll extends Model
{
    protected $fillable =  [
        'title'
    ];

    public function storePollOptions($options){
        $array_options = [];

        foreach($options as $option){
            array_push($array_options, [
                'name' => $option,
                'poll_id' => $this->id
            ]);
        }

        DB::table('poll_options')->insert($array_options);
    }
}
