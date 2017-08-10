<?php

namespace App\Http;

class HelperFunctions
{
    protected $user;

    /*
    *Prepara um array com ['table_col' => val] para inserir no banco uma imagem
    */
    public static function prepateImgsToDb($postId, $imgs) {
        $data = [];
        foreach ($imgs as $img) {
            array_push($data, [
                'post_id' => $postId,
                'img_path' => '/storage/' . $img
            ]);
        }

        return $data;
    }

    public static function dayOfWeekByNum($day) {
        switch ($day) {
            case 0:
                return 'domingo';
            case 1:
                return 'segunda-feira';
                break;
            case 2:
                return 'terca-feira';
                break;
            case 3:
                return 'quarta-feira';
                break;
            case 4:
                return 'quinta-feira';
                break;
            case 5:
                return 'sexta-feira';
                break;
            case 6:
                return 'sabado';
                break;
        }
    }
        
}
