<?php

namespace App\Http;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
//use Illuminate\Support\Facades\File;

class UploadManager
{
    protected $user;

    /*
     * Armazena um avatar
     * */
    public static function storeAvatar($user, $avatar) {
        $oldAvatar = $user->avatar;
        if($oldAvatar != null){
            Storage::delete($oldAvatar);
        }


        $fileName = $user->id . "." . $avatar->getClientOriginalExtension();
        $img = Image::make($avatar->getLinkTarget())->resize(800, 800);
        $img->save(storage_path('app/public/avatars/' . $fileName));
        //$avatar->storeAs('/avatars', $fileName);

        $path = '/storage/avatars/' . $fileName;
        return $path;
    }

    public static function storeThumbnail($post, $thumbnail) {
        $oldThumb = $post->thumbnail;
        if($oldThumb != null){
            Storage::delete($oldThumb);
        }

        $fileName = $post->id . "." . $thumbnail->getClientOriginalExtension();
        $path = $thumbnail->storeAs('/thumbnails', $fileName);

        return $path;
    }

    public static function deleteFile($filePath) {
        Storage::delete($filePath);
    }

    public static function storeTempImg($img, $key) {
        //dd($img);
        $fileName = $img->getClientOriginalName();

        $img->storeAs('gallery/temp/' . $key, $fileName);

        $path = '/storage/gallery/' . $fileName;
        return $path;
    }
}
