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
        <div id="days-container" class="p-3">
            <h3>Giornata 1</h3>
            <div class="form-group">
                <label for="days[0][date]">Data</label>
                <input type="date" name="days[0][date]" class="form-control" required>
                <label for="days[0][description]">Descrizione</label>
                <textarea name="days[0][description]" class="form-control"></textarea>
                <div id="stops-container-0" class="p-5">
                    <h4>Tappe</h4>
                    <div class="form-group">
                        <label for="days[0][stops][0][name]">Nome</label>
                        <input type="text" name="days[0][stops][0][name]" class="form-control" required>
                        <label for="days[0][stops][0][description]">Descrizione</label>
                        <textarea name="days[0][stops][0][description]" class="form-control"></textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary add-stop" data-day-index="0">Aggiungi Tappa</button>
            </div>
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
            <div id="days-container-${index}" class="p-3">
                <h3>Giornata ${index + 1}</h3>
                <div class="form-group">
                    <label for="days[${index}][date]">Data</label>
                    <input type="date" name="days[${index}][date]" class="form-control" required>
                    <label for="days[${index}][description]">Descrizione</label>
                    <textarea name="days[${index}][description]" class="form-control"></textarea>
                    <div id="stops-container-${index}" class="p-5">
                        <h4>Tappe</h4>
                        <div class="form-group">
                            <label for="days[${index}][stops][0][name]">Nome</label>
                            <input type="text" name="days[${index}][stops][0][name]" class="form-control" required>
                            <label for="days[${index}][stops][0][description]">Descrizione</label>
                            <textarea name="days[${index}][stops][0][description]" class="form-control"></textarea>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary add-stop" data-day-index="${index}">Aggiungi Tappa</button>
                </div>
        `;
        container.insertAdjacentHTML('beforeend', dayForm);
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('add-stop')) {
            const dayIndex = event.target.getAttribute('data-day-index');
            const container = document.getElementById(`stops-container-${dayIndex}`);
            const index = container.children.length - 1;
            const stopForm = `
                <div class="form-group">
                    <label for="days[${dayIndex}][stops][${index}][name]">Nome</label>
                    <input type="text" name="days[${dayIndex}][stops][${index}][name]" class="form-control" required>
                    <label for="days[${dayIndex}][stops][${index}][description]">Descrizione</label>
                    <textarea name="days[${dayIndex}][stops][${index}][description]" class="form-control"></textarea>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', stopForm);
        }
    });
</script>
@endsection