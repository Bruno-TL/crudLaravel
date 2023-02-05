@extends('admin.layouts.app')

@section('content')
    <h1>Cadastrar New Posts</h1>

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @include('admin.posts._partials.form')
    </form>
@endsection
