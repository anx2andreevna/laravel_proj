@extends('layout')
@section('content')
    <h3>
        Contact
    </h3>
    <p>
        Name: {{ $contact['name'] }}
    </p>
    <p>
        Adres: {{ $contact['adres'] }}
    </p>
    <p>
        Phone: {{ $contact['phone'] }}
    </p>
    <p>
        Email: {{ $contact['email'] }}
    </p>
@endsection
