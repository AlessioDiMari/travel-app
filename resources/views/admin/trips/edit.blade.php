@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifica Viaggio</h1>
    <form id="trip-form" action="{{ route('admin.trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="title">Titolo</label>
            <input type="text" name="title" class="form-control" value="{{ $trip->title }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Descrizione</label>
            <textarea name="description" class="form-control">{{ $trip->description }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="date">Data</label>
            <input type="date" name="date" class="form-control" value="{{ $trip->date }}" required>
        </div>
        <div id="days-container" class="p-3">
            <h3>Giornate</h3>
            @foreach ($trip->days as $index => $day)
            <div class="day-group" id="day-group-{{ $index }}">
                <h3>Giornata {{ $index + 1 }}</h3>
                <div class="form-group mb-3" id="day-{{ $index }}">
                    <label for="days[{{ $index }}][date]">Data</label>
                    <input type="date" name="days[{{ $index }}][date]" class="form-control" value="{{ $day->date }}" required>
                    <label for="days[{{ $index }}][description]">Descrizione</label>
                    <textarea name="days[{{ $index }}][description]" class="form-control">{{ $day->description }}</textarea>
                    <label for="days[{{ $index }}][image1]">Immagine 1</label>
                    <input type="file" name="days[{{ $index }}][image1]" class="form-control">
                    <label for="days[{{ $index }}][image2]">Immagine 2</label>
                    <input type="file" name="days[{{ $index }}][image2]" class="form-control">
                    <label for="days[{{ $index }}][image3]">Immagine 3</label>
                    <input type="file" name="days[{{ $index }}][image3]" class="form-control">
                    <div id="stops-container-{{ $index }}" class="p-3">
                        <h4>Tappe</h4>
                        @foreach ($day->stops as $stopIndex => $stop)
                            <div class="form-group mb-3" id="stop-{{ $index }}-{{ $stopIndex }}">
                                <label for="days[{{ $index }}][stops][{{ $stopIndex }}][name]">Nome tappa</label>
                                <input type="text" name="days[{{ $index }}][stops][{{ $stopIndex }}][name]" class="form-control" value="{{ $stop->name }}" required>
                                <label for="days[{{ $index }}][stops][{{ $stopIndex }}][description]">Descrizione</label>
                                <textarea name="days[{{ $index }}][stops][{{ $stopIndex }}][description]" class="form-control">{{ $stop->description }}</textarea>
                                <label for="days[{{ $index }}][stops][{{ $stopIndex }}][image1]">Immagine 1</label>
                                <input type="file" name="days[{{ $index }}][stops][{{ $stopIndex }}][image1]" class="form-control">
                                <label for="days[{{ $index }}][stops][{{ $stopIndex }}][image2]">Immagine 2</label>
                                <input type="file" name="days[{{ $index }}][stops][{{ $stopIndex }}][image2]" class="form-control">
                                <label for="days[{{ $index }}][stops][{{ $stopIndex }}][image3]">Immagine 3</label>
                                <input type="file" name="days[{{ $index }}][stops][{{ $stopIndex }}][image3]" class="form-control">
                                <button type="button" class="btn btn-danger remove-stop mt-2" data-stop-id="stop-{{ $index }}-{{ $stopIndex }}">Elimina Tappa</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-secondary add-stop mt-2" data-day-index="{{ $index }}">Aggiungi Tappa</button>
                    <button type="button" class="btn btn-danger remove-day mt-2" data-day-id="day-group-{{ $index }}">Elimina Giornata</button>
                </div>
            </div>
            @endforeach
        </div>
        <button type="button" id="add-day" class="btn btn-secondary mt-3">Aggiungi Giornata</button>
        <button type="submit" class="btn btn-primary mt-3">Salva</button>
    </form>
</div>

<script>
    document.getElementById('add-day').addEventListener('click', function() {
        const container = document.getElementById('days-container');
        const index = container.children.length;
        const dayForm = `
            <div class="day-group" id="day-group-${index}">
                <h3>Giornata ${index + 1}</h3>
                <div class="form-group mb-3" id="day-${index}">
                    <label for="days[${index}][date]">Data</label>
                    <input type="date" name="days[${index}][date]" class="form-control" required>
                    <label for="days[${index}][description]">Descrizione</label>
                    <textarea name="days[${index}][description]" class="form-control"></textarea>
                    <label for="days[${index}][image1]">Immagine 1</label>
                    <input type="file" name="days[${index}][image1]" class="form-control">
                    <label for="days[${index}][image2]">Immagine 2</label>
                    <input type="file" name="days[${index}][image2]" class="form-control">
                    <label for="days[${index}][image3]">Immagine 3</label>
                    <input type="file" name="days[${index}][image3]" class="form-control">
                    <div id="stops-container-${index}" class="p-3">
                        <h4>Tappe</h4>
                        <div class="form-group mb-3" id="stop-${index}-0">
                            <label for="days[${index}][stops][0][name]">Nome tappa</label>
                            <input type="text" name="days[${index}][stops][0][name]" class="form-control" required>
                            <label for="days[${index}][stops][0][description]">Descrizione</label>
                            <textarea name="days[${index}][stops][0][description]" class="form-control"></textarea>
                            <label for="days[${index}][stops][0][image1]">Immagine 1</label>
                            <input type="file" name="days[${index}][stops][0][image1]" class="form-control">
                            <label for="days[${index}][stops][0][image2]">Immagine 2</label>
                            <input type="file" name="days[${index}][stops][0][image2]" class="form-control">
                            <label for="days[${index}][stops][0][image3]">Immagine 3</label>
                            <input type="file" name="days[${index}][stops][0][image3]" class="form-control">
                            <button type="button" class="btn btn-danger remove-stop mt-2" data-stop-id="stop-${index}-0">Elimina Tappa</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary add-stop mt-2" data-day-index="${index}">Aggiungi Tappa</button>
                    <button type="button" class="btn btn-danger remove-day mt-2" data-day-id="day-group-${index}">Elimina Giornata</button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', dayForm);
        saveProgress();
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('add-stop')) {
            const dayIndex = event.target.getAttribute('data-day-index');
            const container = document.getElementById(`stops-container-${dayIndex}`);
            const index = container.children.length;
            const stopForm = `
                <div class="form-group mb-3" id="stop-${dayIndex}-${index}">
                    <label for="days[${dayIndex}][stops][${index}][name]">Nome tappa</label>
                    <input type="text" name="days[${dayIndex}][stops][${index}][name]" class="form-control" required>
                    <label for="days[${dayIndex}][stops][${index}][description]">Descrizione</label>
                    <textarea name="days[${dayIndex}][stops][${index}][description]" class="form-control"></textarea>
                    <label for="days[${dayIndex}][stops][${index}][image1]">Immagine 1</label>
                    <input type="file" name="days[${dayIndex}][stops][${index}][image1]" class="form-control">
                    <label for="days[${dayIndex}][stops][${index}][image2]">Immagine 2</label>
                    <input type="file" name="days[${dayIndex}][stops][${index}][image2]" class="form-control">
                    <label for="days[${dayIndex}][stops][${index}][image3]">Immagine 3</label>
                    <input type="file" name="days[${dayIndex}][stops][${index}][image3]" class="form-control">
                    <button type="button" class="btn btn-danger remove-stop mt-2" data-stop-id="stop-${dayIndex}-${index}">Elimina Tappa</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', stopForm);
            saveProgress();
        }

        if (event.target.classList.contains('remove-stop')) {
            const stopId = event.target.getAttribute('data-stop-id');
            document.getElementById(stopId).remove();
            saveProgress();
        }

        if (event.target.classList.contains('remove-day')) {
            const dayId = event.target.getAttribute('data-day-id');
            document.getElementById(dayId).remove();
            saveProgress();
        }
    });

    function saveProgress() {
        const form = document.getElementById('trip-form');
        const formData = new FormData(form);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });
        localStorage.setItem('tripProgress', JSON.stringify(data));
    }

    function loadProgress() {
        const data = JSON.parse(localStorage.getItem('tripProgress'));
        if (data) {
            for (const key in data) {
                if (data.hasOwnProperty(key)) {
                    const element = document.querySelector(`[name="${key}"]`);
                    if (element) {
                        element.value = data[key];
                    }
                }
            }
        }
    }

    document.addEventListener('DOMContentLoaded', loadProgress);
</script>
@endsection