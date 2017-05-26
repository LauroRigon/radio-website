<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
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
     * Armazena no banco uma votação
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->input();
        $validator = Validator::make($data, [
            'title' => 'required',
            'options' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json([
                $validator->errors()
            ]);
        }

        $newPoll = Poll::create([
            'title' => $data['title']
        ]);

        $newPoll->storePollOptions($data['options']);

        return $newPoll;
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
        if(!Poll::canVote($request, $pollId)){
            return response()->json([
                'status' => 'Já votado!'
            ], 422);
        }

        Poll::storeVote($request->input('option'));

        return response()->json([
            'status' => 'Voto efetuado com sucesso!'
        ], 200);
    }
}
