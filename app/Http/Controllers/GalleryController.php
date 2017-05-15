<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\UploadManager;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Guarda imagens da galeria de um post em uma pasta temporária.
     *
     * @param  int  $request (image, galleryKey)
     * @return \Illuminate\Http\Response
     */
    public function storeTempGallery(Request $request) {
        $img = $request->file('images');
        $galleryKey = $request->galleryKey;

        $validator = Validator::make($request->all(), [
            'images' => 'required|mimes:jpeg,bmp,png,jpg'
        ]);

        /*Retorna os erros se ouver*/
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        UploadManager::storeTempImg($img, $galleryKey);

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Deleta uma imagem da pasta temporaria
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $imgInfo)
    {
        dd($imgInfo->input());
    }
}
