@extends('admin.layouts.app')

@section('title', 'Listagem dos Posts')

@section('content')
    <h1>Posts</h1>

    @if (session('message'))
        <div>
            {{ session('message') }}
        </div>

    @endif

    <br>

    <form action="{{ route('posts.search') }}" method="post">
        @csrf
        <input type="text" name="search" placeholder="Pesquisar:">
        <button type="submit">Buscar</button>
    </form>

    <br>
    @foreach ($posts as $post)
        <p>{{ $post->title }}
            {{ $post->content }}
            [
            <a href="{{ route('posts.show', $post->id) }}">Ver</a>
            <a href="{{ route('posts.edit', $post->id) }}">Editar</a>

            ]</p>
    @endforeach

    <a href="{{ route('posts.created.create') }}">Criar um novo post</a>
    <hr>

    @if(isset($filters))
        {{ $posts->appends($filters)->links() }}
    @else
        {{ $posts->links() }}
    @endif




@endsection
