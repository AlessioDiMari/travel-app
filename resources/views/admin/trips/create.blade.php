@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crea Nuovo Viaggio</h1>
    <form action="{{ route('admin.trips.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="date">Data</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
</div>
@endsection