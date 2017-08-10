<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Retorna todas notificações
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getNotifications()
    {
        $user = User::find(Auth::user()->id);

        return response()->json([
            $user->notifications
        ], 200);
    }

    /**
     * Marca como lida uma notificação
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markAsRead()
    {
        $user = User::find(Auth::user()->id);

        $user->unreadNotifications->markAsRead();

        return response()->json([
            true
        ], 200);
    }
}
