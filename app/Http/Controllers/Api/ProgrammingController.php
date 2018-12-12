<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Programming;
use App\Http\Controllers\Controller;


class ProgrammingController extends Controller
{
    /**
     * Retorna a programação do dia
     * @return \Illuminate\Http\Response
     */
    public function getTodayProgramming(Request $request) {
        Carbon::setLocale('pt_BR');
        $dayOfWeek = Carbon::now()->dayOfWeek;

        switch($dayOfWeek){
            case 0:
                $dayOfWeek = "domingo";
                break;
            case 1:
                $dayOfWeek = "segunda-feira";
                break;
            case 2:
                $dayOfWeek = "terça-feira";
                break;
            case 3:
                $dayOfWeek = "quarta-feira";
                break;
            case 4:
                $dayOfWeek = "quinta-feira";
                break;
            case 5:
                $dayOfWeek = "sexta-feira";
                break;
            case 6:
                $dayOfWeek = "sabado";
                break;
        }

        $todayProgramming = Programming::where('day_of_week', $dayOfWeek)->get();


        return response()->json($todayProgramming, 200);
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
