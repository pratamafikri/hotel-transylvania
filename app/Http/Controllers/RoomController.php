<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function checkin (Request $request) {
        
        $cari = $request->input('reservation_code');
 
        $reservation = \DB::table('reservation')
            ->where('reservation_code', $cari)
            ->get();

        if(!isset($cari)){
            return view('room.checkin');
        }
        if(count($reservation) < 1){
            echo "<script type='text/javascript'>alert('Tidak ada nomor reservasi $cari');</script>";
            return view('room.checkin');
        }

        $user = \DB::table('users')
            ->where('id', $reservation[0]->user_id)
            ->get();

        $room = \DB::table('room')
            ->where('id', $reservation[0]->room_id)
            ->get();

        return view('room.checkin', ['reservation' => $reservation, 'user' => $user, 'room' => $room]);
    }

    public function update_checkin(Request $request, string $id)
    {
        $type = "checkin";

        $user = User::find($request->user_id);
        $reservation = Reservation::find($request->reservation_id);
        $room = Room::find($request->room_id);

        $user->no_ktp = $request->no_ktp;
        $user->fullname = $request->fullname;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->nationality = $request->nationality;
        
        $reservation_code = $request->reservation_code;
        
        if($room->status == "occupied"){
            $room->status = "available";
            // tambah pengecekan lebih dari hari disini

            $check_out_date_before = $request->input('check_out_date_before');
            $check_out_date = date('Y-m-d H:i:s');
            // $check_out_date = $request->check_out_date;

            //ubah date dari string ke format UNIX timestamp, lalu dibagi 24 jam (dalam bentuk detik)
            $compare_time = strtotime($check_out_date_before) - strtotime($check_out_date);
            $time_diff = $compare_time / 86400;

            if($time_diff > 0) {
                $day_count = $request->input('number_of_days') + number_format($time_diff, 0);
                $reservation->number_of_days = $day_count;
                $reservation->check_out_date = $request->input('check_out_date');
                $reservation->total_amount = $room->price * $day_count;
            }

            $type = "checkout";
        }
        else {
            $room->status = "occupied";
        }

        $room->save();
        $user->save();
        $reservation->save();

        $msg = ucfirst($type)." berhasil. ";

        if($type == "checkout")
            $msg .= '<a class="text-white-50" href="' . route("book.invoice", $reservation_code) . '" target="_blank">Klik disini untuk cetak invoice</a>';

        return redirect('room/checkin?reservation_code='.$request->reservation_code)->with('msg', $msg);
    }
}
