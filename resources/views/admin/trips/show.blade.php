@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $trip->title }}</h1>
    <p>{{ $trip->description }}</p>
    <p>{{ $trip->date }}</p>
    <a href="{{ route('trips.edit', $trip->id) }}" class="btn btn-warning">Modifica</a>
    <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Elimina</button>
    </form>
</div>
@endsection