<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Poll extends Model
{
    protected $fillable =  [
        'title', 'user_id'
    ];

    public function options() {
        return $this->hasMany('App\PollOption');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    /*MUTATORS*/

    public function getCreatedAtAttribute($value)
    {
        $date = date_create($value);

        return date_format($date, 'd-m-Y');
    }

    public function getStatusAttribute($value)
    {
        if($value){
            return 'Aberta';
        }
        return 'Fechada';
    }

    /*
     * Armazena as opções de uma enquete
     * */
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

    /*
     * Verifica se certo ip pode votar em uma determinada enquete. Se puder ele já adiciona no banco registrando que foi votado
     * */
    public static function canVote($request, $pollId) {
        $exist = DB::table('poll_controls')
            ->where('ip', $request->ip())
            ->where('poll_id', $pollId)
            ->get();

        if(isset($exist[0])){
            return false;
        }else{
            return DB::table('poll_controls')->insert([
                'ip' => $request->ip(),
                'poll_id' => $pollId
            ]);
        }
    }

    public static function storeVote($option) {
        DB::table('poll_options')
            ->where('id', $option)
            ->increment('vote_count');
    }
}
