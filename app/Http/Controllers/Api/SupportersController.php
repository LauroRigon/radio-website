<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Supporter;
use App\Http\Controllers\Controller;
use App\Http\UploadManager;
use Illuminate\Support\Facades\Validator;

class SupportersController extends Controller
{
    /**
     * Retorna todos apoiadores de um determindado lado (para o front)
     * @param side
     * @return \Illuminate\Http\Response
     */
    public function getSupporters(Request $request, $side) {
        $supporters = Supporter::where('side' , $side)->where('status', 1)->get();

        return response()->json($supporters, 200);
    }
}
