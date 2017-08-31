<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\UploadManager;
use Illuminate\Support\Facades\Validator;
use App\Post;

class GalleryController extends Controller
{

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
     * retorna galeria de imagem de um post
     * @param  Request  $post_id
     * @return \Illuminate\Http\Response
     */
    public function getGallery(Post $post) {
        $gallery = $post->galleries()->get();

        return response()->json([
            $gallery
        ], 200);
    }

    /**
     * Deleta uma imagem da pasta temporaria
     *
     * @param  Request  $imgInfo('galleryKey', 'fotoName')
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $imgInfo)
    {
        if(!UploadManager::destroyTempImg($imgInfo->fileName, $imgInfo->galleryKey)){
            return response()->json([
                'status' => 'Erro ao deletar imagem!'
            ], 422);
        }

        return response()->json([
            'status' => 'Imagem removida com sucesso!'
        ], 200);
    }
}
