<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room = Room::all();

        return view('room.index', ['room'=>$room]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'room_number' => 'required',
            'room_type' => 'required',
            'bed' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);

        Room::create([
            'room_number'  => $request->room_number,
            'room_type'=> $request->room_type,
            'bed' => $request->bed,
            'price' => $request->price,
            'status' => $request->status,
            'maintenance_start' => $request->maintenance_start,
            'maintenance_end' => $request->maintenance_end,
        ]);
        return redirect('/room');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    { 
        $room = Room::find($id);
        return view('room.edit', ['room' => $room, 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'room_number' => 'required',
            'room_type' => 'required',
            'bed' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);

        $room = Room::find($id);
        $room->update($request->all());

        return redirect('room');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::find($id);
        $room->delete();

        return redirect('room');
    }
}
