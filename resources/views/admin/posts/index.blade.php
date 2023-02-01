<h1>Posts</h1>
<a href="{{ route('posts.create') }}">Created new post</a>

@foreach ($posts as $post)
    <p>{{ $post->title }} => {{ $post->content }}</p>
@endforeach