@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between align-items-center mb-4">
        <div class="col-auto">
            <h1 class="mb-0">Viaggi</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.trips.create') }}" class="btn btn-primary">Aggiungi Viaggio</a>
        </div>
    </div>
    
    <div class="row">
        @foreach ($trips as $trip)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('admin.trips.show', $trip->id) }}">{{ $trip->title }}</a>
                        </h5>
                        <p class="card-text">{{ $trip->description }}</p>
                        <p class="card-text"><small class="text-muted">Data: {{ $trip->date }}</small></p>
                        
                        <h6 class="mt-3">Giornate:</h6>
                        <ul class="list-unstyled">
                            @foreach ($trip->days as $day)
                                <li class="mb-2">
                                    <strong>{{ $day->date }}</strong>: {{ $day->description }}
                                    @if($day->stops->count() > 0)
                                        <ul>
                                            @foreach ($day->stops as $stop)
                                                <li>{{ $stop->name }}: {{ $stop->description }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        
                        <div class="mt-3">
                            <a href="{{ route('admin.trips.show', $trip->id) }}" class="btn btn-sm btn-info">Visualizza</a>
                            <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-sm btn-warning">Modifica</a>
                            <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo viaggio?')">Elimina</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection