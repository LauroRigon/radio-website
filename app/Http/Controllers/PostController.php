<?php

namespace App\Http\Controllers;

use App\Notifications\PostRevised;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\UploadManager;
use App\Post;
use App\Category;
use App\Http\HelperFunctions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

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
     * Mostra a página de posts pendentes de aprovação
     *
     * @return \Illuminate\Http\Response
     */
    public function pending() {
        return view('dashboard.post.pending');
    }

    /**
     * Mostra a página de todos os posts
     *
     * @return \Illuminate\Http\Response
     */
    public function all() {
        return view('dashboard.post.all');
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
            'slug' => str_slug($data['title']),
            'content' => $data['content'],
            'category_id' => $data['category_id'],
            'user_id' => $request->user()->id
        ]);

        if(isset($data['thumbnail'])){
            $path = UploadManager::storeThumbnail($postCreated, $data['thumbnail']);
            $postCreated->thumbnail = $path;
            $postCreated->update();
        }

        //Se o diretório da key existe então é copiado os arquivos e cadastrado a galeria no banco
        if($galleryImgsStoredPath = UploadManager::recoveryImg($postCreated->id, $data['galleryKey'], $data['PostGalleryImgs'])) {
            DB::table('galleries')->insert(HelperFunctions::prepateImgsToDb($postCreated->id, $galleryImgsStoredPath));
        }

        $userToNotificate = \App\User::where('is_master', 1)->get();
        Notification::send($userToNotificate, new PostRevised($postCreated, 'Uma postagem foi enviada!', 'Uma postagem está a espera por aprovação!', 'fa-info-circle text-blue', route('post_preview', $postCreated->id)));
        //$userToNotificate->notify(new PostRevised($postCreated, 'Uma postagem sua foi reprovada!', '', 'fa-warning text-yellow', route('post_preview', $postCreated->id)));

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
        //$created_by = $post->user();
        //dd($created_by->get());
        return view('dashboard.post.preview')->with([
            'post' => $post,
  //          'gallery' => $gallery
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Auth::id() != $post->user_id && Auth::user()->is_master !== 'Sim'){
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
            'status' => 'Notícia deletada com sucesso!'
        ], 200);
    }

    /**
     * Permite a publicação de um post
     *
     * @param  int  $id (post)
     * @param  Request  $request (allowed(bool), published_at = Y-m-d H:i:s)
     * @return \Illuminate\Http\Response
     */
    public function approvePost(Post $post){
        $post->published_at = Carbon::create();
        $post->allowed = 1;
        $post->save();

        $userToNotificate = \App\User::find($post->user_id);
        $userToNotificate->notify(new PostRevised($post, "Uma postagem sua foi publicada!", '', "fa-check-circle text-green", route('post_preview', $post->id)));

        //Notification::send($userToNotificate, new PostRevised($post, "Uma postagem sua foi publicada!", "success"));

        return response()->json([
            'status' => 'Postagem publicada com sucesso!'
        ], 200);
    }

    /**
     * Permite a publicação de um post
     *
     * @param  int  $id (post)
     * @return \Illuminate\Http\Response
     */
    public function disapprovePost(Request $request, Post $post){
        $validator = Validator::make($request->input(), [
            'message' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                $validator->errors()
            ], 422);
        }

        $userToNotificate = \App\User::find($post->user_id);
        $userToNotificate->notify(new PostRevised($post, 'Uma postagem sua foi reprovada!', $request->input()['message'], 'fa-warning text-yellow', route('post_preview', $post->id)));

        //Notification::send($userToNotificate, new PostRevised($post, "Uma postagem sua foi publicada!", "success"));

        return response()->json([
            'status' => 'Postagem reprovada! O criador será notificado e poderá modificá-la!'
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
        $posts = Post::where('user_id', $request->user()->id)->paginate(15);

        return response()->json([
            $posts
        ], 200);
    }

    /**
     * Retorna todos os posts ainda não autorizados
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPendingPosts() {
        $posts = Post::where('allowed', 0)->paginate(15);

        return response()->json([
            $posts
        ], 200);
    }

    /**
     * Retorna todos os posts ainda não autorizados
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getGallery(Post $post) {
        $gallery = $post->galleries()->get();

        return response()->json([
            $gallery
        ], 200);
    }

    /**
     * Retorna todos os posts
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAllPosts() {
        $posts = Post::paginate(15);

        foreach($posts as $post) {
            $post->user_name = $post->user()->get()[0]->name;
        }

        return response()->json([
            $posts
        ], 200);
    }
}
