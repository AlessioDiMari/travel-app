<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Day;
use App\Models\Stop;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                'image1' => isset($dayData['image1']) ? $this->uploadImage($dayData['image1']) : null,
                'image2' => isset($dayData['image2']) ? $this->uploadImage($dayData['image2']) : null,
                'image3' => isset($dayData['image3']) ? $this->uploadImage($dayData['image3']) : null,
            ]);

            foreach ($dayData['stops'] as $stopData) {
                $day->stops()->create([
                    'name' => $stopData['name'],
                    'description' => $stopData['description'],
                    'image1' => isset($stopData['image1']) ? $this->uploadImage($stopData['image1']) : null,
                    'image2' => isset($stopData['image2']) ? $this->uploadImage($stopData['image2']) : null,
                    'image3' => isset($stopData['image3']) ? $this->uploadImage($stopData['image3']) : null,
                    'destination' => $stopData['destination'],
                ]);
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
                'image1' => isset($dayData['image1']) ? $this->uploadImage($dayData['image1']) : null,
                'image2' => isset($dayData['image2']) ? $this->uploadImage($dayData['image2']) : null,
                'image3' => isset($dayData['image3']) ? $this->uploadImage($dayData['image3']) : null,
            ]);

            foreach ($dayData['stops'] as $stopData) {
                $day->stops()->create([
                    'name' => $stopData['name'],
                    'description' => $stopData['description'],
                    'image1' => isset($stopData['image1']) ? $this->uploadImage($stopData['image1']) : null,
                    'image2' => isset($stopData['image2']) ? $this->uploadImage($stopData['image2']) : null,
                    'image3' => isset($stopData['image3']) ? $this->uploadImage($stopData['image3']) : null,
                    'destination' => $stopData['destination'],
                ]);
            }
        }

        return redirect()->route('admin.trips.index');
    }

    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('admin.trips.index');
    }

    private function uploadImage($image)
    {
        if ($image) {
            return Storage::disk('public')->put('images', $image);
        }
        return null;
    }
}