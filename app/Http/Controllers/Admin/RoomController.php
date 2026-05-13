<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
{
    $rooms = Room::with('roomType')->get();

    return view(
        'admin.rooms.index',
        compact('rooms')
    );
}

    public function create()
    {
        $roomTypes = RoomType::all();

        return view(
            'admin.rooms.create',
            compact('roomTypes')
        );
    }

    public function store(Request $request)
{
    $request->validate([
        'room_type_id' => 'required',
        'room_number' => 'required|unique:rooms',
        'image' => 'nullable|image|max:2048',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {

        $imagePath = $request->file('image')
            ->store('rooms', 'public');
    }

    Room::create([
        'room_type_id' => $request->room_type_id,
        'room_number' => $request->room_number,
        'is_available' => true,
        'image' => $imagePath,
    ]);

    return redirect()
        ->route('admin.rooms.index')
        ->with('success', 'Room Created');
}

    public function edit(Room $room)
    {
        $roomTypes = RoomType::all();

        return view(
            'admin.rooms.edit',
            compact('room', 'roomTypes')
        );
    }

    public function update(Request $request, Room $room)
{
    $request->validate([
        'room_type_id' => 'required',
        'room_number' => 'required|unique:rooms,room_number,' . $room->id,
        'image' => 'nullable|image|max:2048',
    ]);

    $imagePath = $room->image;

    // Upload New Image
    if ($request->hasFile('image')) {

        // Delete old image
        if ($room->image &&
            Storage::disk('public')->exists($room->image)) {

            Storage::disk('public')->delete($room->image);
        }

        // Store new image
        $imagePath = $request->file('image')
            ->store('rooms', 'public');
    }

    $room->update([
        'room_type_id' => $request->room_type_id,
        'room_number' => $request->room_number,
        'is_available' => $request->is_available,
        'image' => $imagePath,
    ]);

    return redirect()
        ->route('admin.rooms.index')
        ->with('success', 'Room Updated Successfully');
}

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room Deleted');
    }
}