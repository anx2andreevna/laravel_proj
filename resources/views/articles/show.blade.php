@extends('layout')
@section('content')
    <div class="card" style="width: 38rem;">
        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">{{ $article->shortDesc }}</h6>
            <p class="card-text">{{ $article->desc }}</p>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="/article/{{ $article->id }}/edit" class="btn btn-link">Edit</a>
                <form action="/article/{{ $article->id }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-link" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
