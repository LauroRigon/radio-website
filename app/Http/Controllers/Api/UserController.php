<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    /**
     * Retorna todos os usuário (locutores)
     * @return \Illuminate\Http\Response
     */
    public function getUsers(Request $request) {
        $users = User::all()->map(function ($item) {
            return ['id' => $item->id, 'name' => $item->name, 'avatar' => $item->avatar];
        });

        return response()->json($users, 200);
    }

    /**
     * Retorna a programação geral
     * @return \Illuminate\Http\Response
     */
    public function getProgramming(Request $request) {
       $programming = Programming::query()->orderBy('time')->get();

        return response()->json($programming, 200);
    }
}
