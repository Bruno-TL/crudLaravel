@extends('admin.layouts.app')

@section('content')
    <h1>Cadastrar New Posts</h1>

    <form action="{{ route('posts.store') }}" method="post">
        @include('admin.posts._partials.form')
    </form>
@endsection
