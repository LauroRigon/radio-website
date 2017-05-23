<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\UploadManager;
use App\Post;
use App\Category;
use App\Http\HelperFunctions;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.post.index');
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
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'mimes:jpeg,bmp,png,jpg'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        $postCreated = Post::create([
            'title' => $data['title'],
            'subtitle' => $data['subtitle'],
            'content' => $data['content'],
            'category_id' => $data['category_id'],
            'user_id' => $request->user()->id
        ]);

        if(isset($data['thumbnail'])){
            $path = UploadManager::storeThumbnail($postCreated, $data['thumbnail']);
            $postCreated->thumbnail = $path;
            $postCreated->update();
        }

        //Se o diretório da key existe enão é copiado os arquivos e cadastrado a galeria no banco
        if($galleryImgsStoredPath = UploadManager::recoveryImg($postCreated->id, $data['galleryKey'], $data['PostGalleryImgs'])) {
            DB::table('galleries')->insert(HelperFunctions::prepateImgsToDb($postCreated->id, $galleryImgsStoredPath));
        }

        $request->session()->flash('alert', 'Postagem cadastrada com sucesso! Será publicada assim que um usuário master a revisar.');
        return redirect()->route('post_preview', ['post' => $postCreated->id]);
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
     * Mostra um preview de um determinado post na parte de adm
     *
     * @param  int  $postid
     * @return \Illuminate\Http\Response
     */
    public function preview(Post $post)
    {
        return view('dashboard.post.preview')->with('post', $post);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Auth::id() != $post->user_id){
            return redirect('admin/dashboard');
        }
        $categories = Category::all();

        return view('dashboard.post.edit')->with([
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Atualiza um post
     *
     * @param  \Illuminate\Http\Request  $request (title, subtitle, content, category_id)
     * @param  int  $id (postId)
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required',
            'subtitle' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'mimes:jpeg,bmp,png,jpg'
        ]);

        if($validator->fails()){
            return response()->json([
                $validator->errors()
            ]);
        }

        if(isset($data['thumbnail'])){
            $path = UploadManager::storeThumbnail($post, $data['thumbnail']);
            $post->thumbnail = $path;
        }

        $post->title = $data['title'];
        $post->subtitle = $data['subtitle'];
        $post->content = $data['content'];
        $post->category_id = $data['category_id'];
        $post->update();

        $request->session()->flash('success', 'Postagem atualizada com sucesso.');
        return redirect()->route('post_preview', ['post' => $post->id]);
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

    /**
     * Retorna todos os posts do usuário logado
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getMyPosts(Request $request) {
        $posts = Post::where('user_id', $request->user()->id)->get();


        return response()->json([
            $posts
        ], 200);
    }
}
