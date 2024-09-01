@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $trip->title }}</h1>
    <p>{{ $trip->description }}</p>
    <p>{{ $trip->date }}</p>
    <h4>Giornate</h4>
    <ul>
        @foreach ($trip->days as $day)
            <li>
                <p>{{ $day->date }}</p>
                <p>{{ $day->description }}</p>
                <h5>Tappe</h5>
                <ul>
                    @foreach ($day->stops as $stop)
                        <li>
                            <p>{{ $stop->name }}</p>
                            <p>{{ $stop->description }}</p>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-warning">Modifica</a>
    <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Elimina</button>
    </form>
</div>
@endsection