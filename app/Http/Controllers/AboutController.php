<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * Atualiza o about da página
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $request (name, email)
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ]);

        /*Retorna os erros se ouver*/
        if ($validator->fails()){
            return response()->json([
                $validator->errors()
            ]);
        }

        $about = new About();

        return response()->json([
            'status' => 'Atualizado com sucesso!'
        ], 200);
    }


    /**
     * Envia imagem da sessão about
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadImg(Request $request)
    {
        //dd($request->all());
        //dd($request->user()->id);     usar isso se possivel quando tiver login
        $validator = Validator::make($request->all(), [
            'avatar' => 'mimes:jpeg,bmp,png,jpg'
        ]);

        /*Retorna os erros se ouver*/
        if ($validator->fails()){
            return response()->json([
                $validator->errors()
            ]);
        }

        $path = UploadManager:: storeAvatar($id, $request->file('avatar'));

        $id->avatar = $path;
        $id->update();

        return response()->json([
            'status' => 'Avatar atualizado com sucesso!'
        ], 200);
    }
}
