@extends('layouts.app')

@section('content')

<div class="container p-5">
    <h1>Benvenuto {{$user->name}} nella tua pagina di gestione viaggi</h1>
    @dump($user)
</div>

@endsection