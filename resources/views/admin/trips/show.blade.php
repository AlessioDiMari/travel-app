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
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">{{ $day->date }}</h3>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $day->description }}</p>
                
                @if($day->image1 || $day->image2 || $day->image3)
                    <div id="carouselDay{{ $loop->index }}" class="carousel slide mb-4" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach(['image1', 'image2', 'image3'] as $index => $image)
                                @if($day->$image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $day->$image) }}" class="d-block w-100" alt="Immagine {{ $index + 1 }}" style="height: 300px; width: 300px; object-fit: cover;">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselDay{{ $loop->index }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselDay{{ $loop->index }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @endif

                @if($day->stops->count() > 0)
                    <h4 class="mt-4 mb-3">Tappe:</h4>
                    <div class="list-group">
                        @foreach ($day->stops as $stop)
                            <div class="list-group-item">
                                <h5 class="mb-1">{{ $stop->name }}</h5>
                                <p class="mb-1">{{ $stop->description }}</p>
                                @if($stop->destination)
                                    <p class="mb-1"><strong>Luogo di destinazione:</strong> {{ $stop->destination }}</p>
                                @endif
                                @if($stop->image1 || $stop->image2 || $stop->image3)
                                    <div id="carouselStop{{ $loop->parent->index }}{{ $loop->index }}" class="carousel slide mt-3" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach(['image1', 'image2', 'image3'] as $index => $image)
                                                @if($stop->$image)
                                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                        <img src="{{ asset('storage/' . $stop->$image) }}" class="d-block w-100" alt="Immagine {{ $index + 1 }}" style="height: 200px; width: 200px; object-fit: cover;">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselStop{{ $loop->parent->index }}{{ $loop->index }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselStop{{ $loop->parent->index }}{{ $loop->index }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection