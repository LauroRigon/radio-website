<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supporter;
use App\Http\UploadManager;
use Illuminate\Support\Facades\Validator;
class SupportersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.supporter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.supporter.create');
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
            'image' => 'mimes:jpeg,bmp,png,jpg',
            'side' => 'required'
        ]);

        /*Retorna os erros se ouver*/
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        $createdSupp = Supporter::create([
           'name' => $data['name'],
            'link' => $data['link'],
            'status' => (isset($data['status']))? 1: 0,
            'side' => $data['side']
        ]);

        if(isset($data['image'])) {
            $path = UploadManager::storeSupporterImg($createdSupp, $data['image']);
            $createdSupp->image = $path;
        }

        $createdSupp->save();

        $request->session()->flash('success', 'Apoiador criado com sucesso!');
        return redirect()->back();
    }

    /**
     * Mostra a página de edição.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supporter $supporter)
    {
        return view('dashboard.supporter.edit')->with([
            'supporter' => $supporter
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supporter $supporter)
    {
        $data = $request->all();
        //dd($data);
        $validator = Validator::make($data, [
            'name' => 'required',
            'image' => 'mimes:jpeg,bmp,png,jpg'
        ]);

        /*Retorna os erros se ouver*/
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        if(isset($data['image'])){
            $path = UploadManager::storeSupporterImg($supporter, $data['image']);
            $supporter->image = $path;
        }

        $supporter->name = $data['name'];
        $supporter->link = $data['link'];
        $supporter->side = $data['side'];
        $supporter->status = (isset($data['status']))? 1: 0;
        $supporter->update();

        $request->session()->flash('success', 'Apoiador atualizado com sucesso!');
        return redirect()->back();
    }

    public function destroy(Supporter $supporter)
    {
        $supporter->delete();

        return response()->json([
            'status' => 'Apoiador deletado com sucesso!'
        ], 200);
    }

    /**
     * Retorna todos os apoiadores
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSupporters()
    {
        $supporters = Supporter::paginate(10);
        foreach($supporters as $supporter){
            $supporter->status = ($supporter->status == '1')? "Ativo": "Desativado";
        }
        return response()->json([
            $supporters
        ], 200);
    }
}
