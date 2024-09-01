@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifica Viaggio</h1>
    <form action="{{ route('admin.trips.update', $trip->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" name="title" class="form-control" value="{{ $trip->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea name="description" class="form-control">{{ $trip->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="date">Data</label>
            <input type="date" name="date" class="form-control" value="{{ $trip->date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
</div>
@endsection