<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
       // $posts = Post::all();
        //paginação paginate();
        //ordenando orderBy(); 1- params = index; 2- parmas= DESC ou ASC
        // Antigos para os mais novos latest();
        $posts = Post::latest()->paginate(1);

        return view('admin/posts/index', compact('posts'));
    }

    public function created()
    {
        return view('admin/posts/created');
    }

    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();

        if ($request->image->isValid()){
            $nameFile = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtensio();
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }


        Post::create($data);

        return redirect()->route('posts.index')->with('message', 'Create sucess');
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

        if (Storage::exists($post->image)) Storage::delete($post->data);

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

    public function update(StoreUpdatePost $request,$id)
    {
        if(!$post = Post::find($id)){
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->image->isValid()) {
            if (Storage::exists($post->image)) Storage::delete($post->data);

            $nameFile = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtensio();
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }

        $post->update($data);
        return redirect()->route('posts.index')->with('message', 'Update sucess');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
                        ->orWhere('content', 'LIKE', "%{$request->search}%")->paginate(1);

        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
