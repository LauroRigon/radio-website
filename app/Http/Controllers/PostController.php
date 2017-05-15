<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\UploadManager;
use App\Post;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::all();

        $galleryKey = time() . $request->user()->id;

        return view('dashboard.post.create')->with([
            'categories' => $categories,
            'galleryKey' => $galleryKey
        ]);
    }

    /**
     * Armazena no banco o post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required',
            'subtitle' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'thumbnail' => 'mimes:jpeg,bmp,png,jpg'
        ]);

        if($validator->fails()){
            return response()->json([
                $validator->errors()
            ]);
        }

        $postCreated = Post::create([
            'title' => $data['title'],
            'subtitle' => $data['subtitle'],
            'content' => $data['content'],
            'category_id' => $data['category_id'],
            'user_id' => $data['user_id']
        ]);

        $path = UploadManager::storeThumbnail($postCreated, $data['thumbnail']);

        $postCreated->thumbnail = $path;
        $postCreated->update();

        return response()->json([
            'status' => 'Notícia armazenada com sucesso. Aguardando aprovação!'
        ], 200);
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
     * Atualiza um post
     *
     * @param  \Illuminate\Http\Request  $request (title, subtitle, content, category_id)
     * @param  int  $id (postId)
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $id) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required',
            'subtitle' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                $validator->errors()
            ]);
        }

        $id->update([
            'title' => $data['title'],
            'subtitle' => $data['subtitle'],
            'content' => $data['content'],
            'category_id' => $data['category_id']
        ]);

        return response()->json([
            'status' => 'Notícia atualizada com sucesso!'
        ], 200);
    }

    /**
     * Remove uma postagem do banco de dados
     *
     * @param  int  $id (post)
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $id) {
        UploadManager::deleteFile($id->thumbnail);
        $id->delete();

        return response()->json([
            'status' => 'Noticia deletada com sucesso!'
        ], 200);
    }

    /**
     * Permite a publicação de um post
     *
     * @param  int  $id (post)
     * @param  Request  $request (allowed(bool), published_at = Y-m-d H:i:s)
     * @return \Illuminate\Http\Response
     */
    public function allowPost(Request $request, Post $id){
        $data = $request->input();
        $validator = Validator::make($data, [
            'allowed' => 'required',
            'published_at' => 'required|date_format:Y-m-d H:i:s'
        ]);

        if($validator->fails()){
            return response()->json([
                $validator->errors()
            ]);
        }

        $id->published_at = $data['published_at'];
        $id->allowed = $data['allowed'];
        $id->save();

        return response()->json([
            'status' => 'Noticia postada com sucesso!'
        ], 200);
    }

    /**
     * Modifica o conteudo da sessão about
     *
     * @param  int  $id (post)
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setAsAbout(Request $request, Post $id) {
        $oldAbout = Post::where('is_about', '=', 1)->delete();

        $id->is_about = 1;
        $id->save();

        return response()->json([
            'status' => 'Sessão Sobre atualizada com sucesso!'
        ], 200);
    }
}
