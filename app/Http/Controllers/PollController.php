<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.poll.index');
    }

    /**
     * Armazena no banco uma enquete
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.poll.create');
    }

    /**
     * Armazena no banco uma enquete
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->input();

        $messages = [
            'required' => 'Este campo é obrigatório!'
        ];
        $validator = Validator::make($data, [
            'title' => 'required',
            'options' => 'required'
        ], $messages);

        if ($validator->fails()){
            return response()->json([
                $validator->errors()
            ], 422);
        }
        $newPoll = Poll::create([
            'title' => $data['title'],
            'user_id' => $request->user()->id
        ]);

        $newPoll->storePollOptions($data['options']);

        return $newPoll;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Poll $poll)
    {
        if($poll->user_id != Auth::user()->id && Auth::user()->is_master == 'Não'){
            $request->session()->flash('warning', 'Você não tem permissão para isso');
            return redirect()->back();
        }
        return view('dashboard.poll.show')->with('poll', $poll);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $id)
    {
        $id->delete();

        return response()->json([
            'status' => 'Deletada com sucesso!'
        ], 200);
    }

    /**
     * Soma o contador de votos de uma enquete. Pelo ip é verificado se já existe um voto nessa enquete com o mesmo ip.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addVote(Request $request, $pollId) {
        $data = $request->input();
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
     * Retorna todas as enquetes do usuário logado
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getMyPolls(Request $request) {
        $polls = Poll::where('user_id', $request->user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            $polls
        ], 200);
    }

    /**
     * Encerra uma enquete
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function closePoll(Request $request, Poll $poll) {

        if(Auth::user()->id != $poll->user_id && Auth::user()->is_master != 'Sim'){
            $request->session()->flash('warning', 'Você não tem permissão parra isso!');
            return redirect()->back();
        }

        $poll->status = 0;
        $poll->save();

        $request->session()->flash('success', 'Enquete encerrada com sucesso!');
        return redirect()->back();
    }

    /**
     * Retorna uma enquete completa (para o front)
     * @param  Poll  $poll (id)
     * @return \Illuminate\Http\Response
     */
    public function getPoll(Request $request, Poll $poll) {
        $poll->options = $poll->options();
        $poll->canVote = $poll->canVote($request, $poll->id);
        $poll->votesSum = $poll->options->sum('vote_count');

        return $poll;
    }
}
