<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Controllers\Controller;


class PostController extends Controller
{
    /**
     * Retorna todas postagens completas (para o front)
     * @return \Illuminate\Http\Response
     */
    public function getPosts(Request $request) {
        $posts = Post::where('allowed', 1)->where('is_about', 0)->orderBy('published_at', 'desc')->with('user')->paginate(10);

        return response()->json($posts, 200);
    }

    /**
     * Retorna uma postagem basedo no slug (para o front)
     * @return \Illuminate\Http\Response
     */
    public function getPost(Request $request, $slug) {
        $post = Post::where('slug', $slug)->where('is_about', 0)->with('galleries')->with('user')->get()[0];

        return response()->json($post, 200);
    }

    /**
     * Retorna todas postagens pela categoria (para o front)
     * @return \Illuminate\Http\Response
     */
    public function getByCategory(Request $request, $categoria) {
        $category = Category::where('name', $categoria)->first();

        $posts = Post::where('category_id', $category->id)->where('allowed', 1)->where('is_about', 0)->orderBy('published_at', 'desc')->with('user')->paginate(10);

        return response()->json($posts, 200);
    }

    /**
     * Retorna a postagem de 'sobre' (para o front)
     * @return \Illuminate\Http\Response
     */
    public function getAbout(Request $request) {
        $about = Post::where('is_about', 1)->with('galleries')->first();

        return response()->json($about, 200);
    }
}
