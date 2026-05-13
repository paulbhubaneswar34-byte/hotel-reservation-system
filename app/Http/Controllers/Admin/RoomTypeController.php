<?php

namespace App\Http\Controllers\Admin;

use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::latest()
            ->paginate(10);

        return view(
            'admin.room-types.index',
            compact('roomTypes')
        );
    }

    public function create()
    {
        return view('admin.room-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price_per_night' => 'required|numeric',
            'capacity' => 'required|integer',
        ]);

        RoomType::create($request->all());

        return redirect()
            ->route('admin.room-types.index')
            ->with('success', 'Room Type Created');
    }

    public function edit(RoomType $roomType)
    {
        return view(
            'admin.room-types.edit',
            compact('roomType')
        );
    }

    public function update(
        Request $request,
        RoomType $roomType
    ) {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price_per_night' => 'required|numeric',
            'capacity' => 'required|integer',
        ]);

        $roomType->update($request->all());

        return redirect()
            ->route('admin.room-types.index')
            ->with('success', 'Room Type Updated');
    }

    public function destroy(RoomType $roomType)
    {
        $roomType->delete();

        return redirect()
            ->route('admin.room-types.index')
            ->with('success', 'Room Type Deleted');
    }
}