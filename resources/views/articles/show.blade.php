@extends('layout')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Title</th>
                <th scope="col">shortDesc</th>
                <th scope="col">Desc</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <th scope="row">{{ $article['datePublic'] }}</th>
                    <td>{{ $article['title'] }}</td>
                    <td>{{ $article['shortDesc'] }}</td>
                    <td>{{ $article['desc'] }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
