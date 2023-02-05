

<h1>Posts</h1>

@if (session('message'))
    <div>
        {{ session('message') }}
    </div>

@endif
.....


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
