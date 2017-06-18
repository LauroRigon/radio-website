<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MusicOrder;

class MusicOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.music_order.index');
    }

    /**
     * Cadastra no banco de dados um pedido.
     *
     * @param  \Illuminate\Http\Request  $request(name, content)
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $request (name, email)
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $id)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $id)
    {

    }

    /**
     * Retorna todos os pedidos de musicas
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMusicOrders()
    {
        return MusicOrder::orderBy('created_at', 'desc')->paginate(15);
    }
}
