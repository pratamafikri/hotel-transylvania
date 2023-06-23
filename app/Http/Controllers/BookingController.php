<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking.index');
    }

    public function getAvailableRoom(Request $request)
    {
        $roomType = $request->input('room_type');
        $bedType = $request->input('bed_type');

        // Lakukan proses pencarian berdasarkan room type dan bed type
        $rooms = \DB::table('room')
            ->where('room_type', $roomType)
            ->where('bed', $bedType)
            ->where('status', 'available')
            ->get();

        return response()->json($rooms);
    }

    public function create(Request $request)
    {
        $reservation_code = date('ymdhiU');

        $data = [
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'number_of_days' => $request->durasi,
            'reservation_code' => $reservation_code,
            'total_amount' => $request->room_price * $request->durasi,
        ];
        Reservation::create($data);

        $room = Room::find($request->room_id);
        $room->status = "booked";
        $room->save();

        return redirect()->route('book.index')->with('msg', 'Booking berhasil. <a class="text-white-50" href="' . route("book.invoice", $reservation_code) . '" target="_blank">Klik disini untuk cetak invoice</a>');
    }

    public function printInvoice($reservation_code)
    {
        $reservation = \DB::table('reservation')
            ->join('room', 'reservation.room_id', 'room.id')
            ->join('users', 'reservation.user_id', 'users.id')
            ->select('reservation.*', 'room.room_number', 'room.room_type', 'room.bed', 'room.price', 'users.fullname')
            ->where('reservation.reservation_code', $reservation_code)
            ->first();

        // dd($reservation);

        $filename = 'Invoice_' . $reservation_code . '.pdf';
        $html = '
        <table>
            <tr>
                <td>
                    <h1 style="font-size: 38pt">Hotel<br/>Transylvania</h1>
                </td>
                <td align="right">
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    Date: ' . date("l, d F Y") . '
                </td>
            </tr>
        </table>

        <br/>
        <br/>

        <table>
          <tr>
            <td><br/><br/>Kode Reservasi: ' . $reservation->reservation_code . '</td>
            <td align="right"><h1 style="font-size: 24pt">Invoice</h1></td>
          </tr>
        </table>
        <br/>
        <br/>
        <table cellpadding="5">
            <tbody>
                <tr>
                    <td style="background-color: skyblue">Room #</td>
                    <td style="background-color: skyblue">Name</td>
                    <td style="background-color: skyblue">Check-in</td>
                    <td style="background-color: skyblue">Check-out</td>
                    <td style="background-color: skyblue"># of night</td>
                    <td style="background-color: skyblue">Price /night</td>
                </tr>
                <tr>
                    <td>' . $reservation->room_number . '</td>
                    <td>' . $reservation->fullname . '</td>
                    <td>' . date("d/m/Y", strtotime($reservation->check_in_date)) . '</td>
                    <td>' . date("d/m/Y", strtotime($reservation->check_out_date)) . '</td>
                    <td>' . $reservation->number_of_days . '</td>
                    <td>Rp.' . number_format($reservation->price) . '</td>
                </tr>
            </tbody>
        </table>

        <br/>
        <br/>

        <table cellpadding="5">
        <tr>
            <td colspan="4"></td>
            <td>Grand Total:</td>
            <td>Rp.' . number_format($reservation->total_amount) . '</td>
        </tr>
        </table>

        <br/>
        <br/>
        ';

        $pdf = new TCPDF;

        $pdf::SetTitle('Invoice ' . $reservation_code);
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::Output(public_path($filename), 'I');

        // return response()->download(public_path($filename));
    }
}
