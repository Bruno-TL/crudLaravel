<h1>Posts</h1>

@foreach ($posts as $post)
    <p>{{ $post->title }} => {{ $post->content }}</p>
@endforeach