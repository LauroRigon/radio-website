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
        
}
