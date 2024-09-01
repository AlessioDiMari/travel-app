@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between align-items-center mb-4">
        <div class="col-auto">
            <h1 class="mb-0">{{ $trip->title }}</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-warning">Modifica</a>
            <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo viaggio?')">Elimina</button>
            </form>
            <a href="{{ route('admin.trips.index') }}" class="btn btn-secondary">Torna alla lista</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <p class="card-text">{{ $trip->description }}</p>
            <p class="card-text"><small class="text-muted">Data: {{ $trip->date }}</small></p>
        </div>
    </div>

    <h2 class="mb-3">Giornate</h2>
    @foreach ($trip->days as $day)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $day->date }}</h5>
                <p class="card-text">{{ $day->description }}</p>
                
                @if($day->stops->count() > 0)
                    <h6 class="mt-3">Tappe:</h6>
                    <ul class="list-group">
                        @foreach ($day->stops as $stop)
                            <li class="list-group-item">
                                <strong>{{ $stop->name }}</strong>: {{ $stop->description }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection