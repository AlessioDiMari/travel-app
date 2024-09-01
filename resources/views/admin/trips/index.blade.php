@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Viaggi</h1>
    <a href="{{ route('admin.trips.create') }}" class="btn btn-primary">Aggiungi Viaggio</a>
    <ul>
        @foreach ($trips as $trip)
            <li>
                <a href="{{ route('admin.trips.show', $trip->id) }}">{{ $trip->title }}</a>
                <p>{{ $trip->description }}</p>
                <p>{{ $trip->date }}</p>
                <h4>Giornate</h4>
                <ul>
                    @foreach ($trip->days as $day)
                        <li>
                            <p>{{ $day->date }}</p>
                            <p>{{ $day->description }}</p>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-warning">Modifica</a>
                <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection