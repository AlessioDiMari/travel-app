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
            <div class="form-group" id="day-{{ $index }}">
                <label for="days[{{ $index }}][date]">Data</label>
                <input type="date" name="days[{{ $index }}][date]" class="form-control" value="{{ $day->date }}" required>
                <label for="days[{{ $index }}][description]">Descrizione</label>
                <textarea name="days[{{ $index }}][description]" class="form-control">{{ $day->description }}</textarea>
                <div id="stops-container-{{ $index }}">
                    <h4>Tappe</h4>
                    @foreach ($day->stops as $stopIndex => $stop)
                        <div class="form-group" id="stop-{{ $index }}-{{ $stopIndex }}">
                            <label for="days[{{ $index }}][stops][{{ $stopIndex }}][name]">Nome</label>
                            <input type="text" name="days[{{ $index }}][stops][{{ $stopIndex }}][name]" class="form-control" value="{{ $stop->name }}" required>
                            <label for="days[{{ $index }}][stops][{{ $stopIndex }}][description]">Descrizione</label>
                            <textarea name="days[{{ $index }}][stops][{{ $stopIndex }}][description]" class="form-control">{{ $stop->description }}</textarea>
                            <button type="button" class="btn btn-danger remove-stop" data-stop-id="stop-{{ $index }}-{{ $stopIndex }}">Elimina Tappa</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary add-stop" data-day-index="{{ $index }}">Aggiungi Tappa</button>
                <button type="button" class="btn btn-danger remove-day" data-day-id="day-{{ $index }}">Elimina Giornata</button>
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
        const index = container.children.length;
        const dayForm = `
            <div class="form-group" id="day-${index}">
                <label for="days[${index}][date]">Data</label>
                <input type="date" name="days[${index}][date]" class="form-control" required>
                <label for="days[${index}][description]">Descrizione</label>
                <textarea name="days[${index}][description]" class="form-control"></textarea>
                <div id="stops-container-${index}">
                    <h4>Tappe</h4>
                    <div class="form-group" id="stop-${index}-0">
                        <label for="days[${index}][stops][0][name]">Nome</label>
                        <input type="text" name="days[${index}][stops][0][name]" class="form-control" required>
                        <label for="days[${index}][stops][0][description]">Descrizione</label>
                        <textarea name="days[${index}][stops][0][description]" class="form-control"></textarea>
                        <button type="button" class="btn btn-danger remove-stop" data-stop-id="stop-${index}-0">Elimina Tappa</button>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary add-stop" data-day-index="${index}">Aggiungi Tappa</button>
                <button type="button" class="btn btn-danger remove-day" data-day-id="day-${index}">Elimina Giornata</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', dayForm);
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('add-stop')) {
            const dayIndex = event.target.getAttribute('data-day-index');
            const container = document.getElementById(`stops-container-${dayIndex}`);
            const index = container.children.length;
            const stopForm = `
                <div class="form-group" id="stop-${dayIndex}-${index}">
                    <label for="days[${dayIndex}][stops][${index}][name]">Nome</label>
                    <input type="text" name="days[${dayIndex}][stops][${index}][name]" class="form-control" required>
                    <label for="days[${dayIndex}][stops][${index}][description]">Descrizione</label>
                    <textarea name="days[${dayIndex}][stops][${index}][description]" class="form-control"></textarea>
                    <button type="button" class="btn btn-danger remove-stop" data-stop-id="stop-${dayIndex}-${index}">Elimina Tappa</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', stopForm);
        }

        if (event.target.classList.contains('remove-stop')) {
            const stopId = event.target.getAttribute('data-stop-id');
            document.getElementById(stopId).remove();
        }

        if (event.target.classList.contains('remove-day')) {
            const dayId = event.target.getAttribute('data-day-id');
            document.getElementById(dayId).remove();
        }
    });
</script>
@endsection