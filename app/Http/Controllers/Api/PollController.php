<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Poll;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PollController extends Controller
{
    /**
     * Soma o contador de votos de uma enquete. Pelo ip é verificado se já existe um voto nessa enquete com o mesmo ip.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addVote(Request $request) {
        $data = $request->input();
        $pollId = $request->input()['pollId'];

        $validator = Validator::make($data, [
            'optionChosen' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json([
                $validator->errors()
            ], 422);
        }

        if(!Poll::canVote($request, $pollId)){
            return response()->json([
                'status' => 'Você já votou nessa enquete!'
            ], 422);
        }

        Poll::storeVote($request->input('optionChosen'));
        DB::table('poll_controls')->insert([
            'ip' => $request->ip(),
            'poll_id' => $pollId
        ]);

        return response()->json([
            'status' => 'Voto efetuado com sucesso!'
        ], 200);
    }

    /**
     * Retorna todas enquetes completas (para o front)
     * @return \Illuminate\Http\Response
     */
    public function getPolls(Request $request) {
        $polls = Poll::with('options')->where('status' , 1)->get();

        $polls->map(function($poll) use ($request) {
            return $poll->canVote = $poll->canVote($request, $poll->id);
        });

        return response()->json($polls, 200);
    }

    /**
     * Retorna uma enquete completa (para o front)
     * @param  Poll  $poll (id)
     * @return \Illuminate\Http\Response
     */
    public function getPoll(Request $request, Poll $poll) {
        $poll->options;
        $poll->canVote = $poll->canVote($request, $poll->id);

        return response()->json($poll, 200);
    }
}
