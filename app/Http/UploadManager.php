<?php

namespace App\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UploadManager
{
    protected $user;

    public static function storeAvatar($userId, $avatar){
        return Storage::url('jPVtVIfMc5pXA2dzdeKbbqLO3jXPj9rKSwytxrf8.jpeg');
        return Storage::put('avatars/' + $userId, $avatar);
    }
}
