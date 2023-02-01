<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin/posts/index', compact('posts'));
    }

    public function created()
    {
        return view('admin/posts/created');
    }

    public function store(StoreUpdatePost $request)
    {
        Post::create($request->all());
        
        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        // $post = Post::where('id', $id)->first();
        // ou
        // Já retorna todos os valores escolhendo pelo o id
        if(!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }
        return view('admin/posts/show', compact('post'));
    }

    public function destroy($id)
    {
        if(!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }
        $post->delete();
        return redirect()->route('posts.index')->with('message', 'Post Deletado com sucesso');
    }

    public function edit($id)
    {
        if(!$post = Post::find($id)){
            return redirect()->back();
        }

        return view('admin.posts.edit', compact('post'));
    }
}
 