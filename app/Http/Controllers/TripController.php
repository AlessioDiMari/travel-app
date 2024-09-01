<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Day;
use App\Models\Stop;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::all();
        return view('admin.trips.index', compact('trips'));
    }

    public function create()
    {
        return view('admin.trips.create');
    }

    public function store(StoreTripRequest $request)
    {
        $trip = Trip::create($request->validated());

        foreach ($request->days as $dayData) {
            $day = $trip->days()->create([
                'date' => $dayData['date'],
                'description' => $dayData['description'],
            ]);

            foreach ($dayData['stops'] as $stopData) {
                $day->stops()->create($stopData);
            }
        }

        return redirect()->route('admin.trips.index');
    }

    public function show(Trip $trip)
    {
        return view('admin.trips.show', compact('trip'));
    }

    public function edit(Trip $trip)
    {
        return view('admin.trips.edit', compact('trip'));
    }

    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $trip->update($request->validated());

        $trip->days()->delete();
        foreach ($request->days as $dayData) {
            $day = $trip->days()->create([
                'date' => $dayData['date'],
                'description' => $dayData['description'],
            ]);

            foreach ($dayData['stops'] as $stopData) {
                $day->stops()->create($stopData);
            }
        }

        return redirect()->route('admin.trips.index');
    }

    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('admin.trips.index');
    }
}