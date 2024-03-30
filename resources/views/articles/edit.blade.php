@extends('layout')
@section('content')
    <form action="/article/{{ $article->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Date public</label>
            <input type="date" class="form-control" name="datePublic" id="" value="{{ $article->datePublic }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" name="title" id="" value="{{ $article->title }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Short Description</label>
            <input type="text" class="form-control" name="shortDesc" id="exampleInputPassword1"
                value="{{ $article->shortDesc }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea name="desc" class="form-control">{{ $article->desc }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
