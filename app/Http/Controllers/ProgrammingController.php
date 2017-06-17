<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Programming;

class ProgrammingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Programming::all();
        return view('dashboard.programming.index')->with('programs', $programs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.programming.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'day_of_week' => 'required',
            'time' => 'required|date_format:G:i',
            'type' => 'required|'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $exists = Programming::where('day_of_week', $data['day_of_week'])->where('time', $data['time'])->first();

        if($exists !== null){
            $request->session()->flash('warning', 'Um programa nesse dia e horário já está marcado!');
            return redirect()->back();
        }
        Programming::create([
            'name' => $data['name'],
            'type' => $data['type'],
            'day_of_week' => $data['day_of_week'],
            'time' => $data['time']
        ]);
        $request->session()->flash('success', 'Programação adicionada com sucesso!');
        return redirect()->back();
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
    public function destroy(Programming $program, Request $request)
    {
        $program->delete();
        $request->session()->flash('success', 'Programa deletado com sucesso!');
        return redirect()->back();
    }
}
