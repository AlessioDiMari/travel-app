@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crea Nuovo Viaggio</h1>
    <form id="trip-form" action="{{ route('admin.trips.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="title">Titolo</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Descrizione</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="date">Data</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div id="days-container" class="p-3">
            <div class="day-group" id="day-group-0">
                <h3>Giornata 1</h3>
                <div class="form-group mb-3" id="day-0">
                    <label for="days[0][date]">Data</label>
                    <input type="date" name="days[0][date]" class="form-control" required>
                    <label for="days[0][description]">Descrizione</label>
                    <textarea name="days[0][description]" class="form-control"></textarea>
                    <div id="stops-container-0" class="p-3">
                        <h4>Tappe</h4>
                        <div class="form-group mb-3" id="stop-0-0">
                            <label for="days[0][stops][0][name]">Nome tappa</label>
                            <input type="text" name="days[0][stops][0][name]" class="form-control" required>
                            <label for="days[0][stops][0][description]">Descrizione</label>
                            <textarea name="days[0][stops][0][description]" class="form-control"></textarea>
                            <button type="button" class="btn btn-danger remove-stop mt-2" data-stop-id="stop-0-0">Elimina Tappa</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary add-stop mt-2" data-day-index="0">Aggiungi Tappa</button>
                    <button type="button" class="btn btn-danger remove-day mt-2" data-day-id="day-group-0">Elimina Giornata</button>
                </div>
            </div>
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
                    <div id="stops-container-${index}" class="p-3">
                        <h4>Tappe</h4>
                        <div class="form-group mb-3" id="stop-${index}-0">
                            <label for="days[${index}][stops][0][name]">Nome tappa</label>
                            <input type="text" name="days[${index}][stops][0][name]" class="form-control" required>
                            <label for="days[${index}][stops][0][description]">Descrizione</label>
                            <textarea name="days[${index}][stops][0][description]" class="form-control"></textarea>
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