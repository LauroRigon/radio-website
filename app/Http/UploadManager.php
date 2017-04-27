<?php

namespace App\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
        $avatar->storeAs('/avatars', $fileName);

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
}
