<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MusicOrder;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MusicOrderController extends Controller
{

    /**
     * Armazena um pedido
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->input(), [
            'content' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                $validator->errors()
            ], 422);
        }

        $order = new MusicOrder();
        if(!$order->canSendOrder($request)){
            return response()->json([
                'Você deve esperar para poder enviar outro pedido!'
            ], 422);
        }

        $order->name = ($request->input('name'))? $request->input('name'): 'Anônimo';
        $order->content = $request->input('content');
        $order->user_order_ip = $request->ip();
        $order->expires_date = Carbon::create()->addMinutes(15);
        $order->save();
        return $order;
    }
}
