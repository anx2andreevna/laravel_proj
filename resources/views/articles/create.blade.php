@extends('layout')
@section('content')
    <form action="/article" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Date public</label>
            <input type="date" class="form-control" name="datePublic" id="">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" name="title" id="">
            <div class="form-group">
                <label for="exampleInputPassword1">Short Description</label>
                <input type="text" class="form-control" name="shortDesc" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <textarea name="desc" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
