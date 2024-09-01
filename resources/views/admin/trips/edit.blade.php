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
        <div id="days-container">
            <h3>Giornate</h3>
            @foreach ($trip->days as $index => $day)
                <div class="form-group">
                    <label for="days[{{ $index }}][date]">Data</label>
                    <input type="date" name="days[{{ $index }}][date]" class="form-control" value="{{ $day->date }}" required>
                    <label for="days[{{ $index }}][description]">Descrizione</label>
                    <textarea name="days[{{ $index }}][description]" class="form-control">{{ $day->description }}</textarea>
                </div>
            @endforeach
        </div>
        <button type="button" id="add-day" class="btn btn-secondary">Aggiungi Giornata</button>
        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
</div>

<script>
    document.getElementById('add-day').addEventListener('click', function() {
        const container = document.getElementById('days-container');
        const index = container.children.length - 1;
        const dayForm = `
            <div class="form-group">
                <label for="days[${index}][date]">Data</label>
                <input type="date" name="days[${index}][date]" class="form-control" required>
                <label for="days[${index}][description]">Descrizione</label>
                <textarea name="days[${index}][description]" class="form-control"></textarea>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', dayForm);
    });
</script>
@endsection