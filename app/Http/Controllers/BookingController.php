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
            ->select('reservation.*', 'room.room_number', 'room.room_type', 'room.bed', 'room.price')
            ->where('reservation.reservation_code', $reservation_code)
            ->first();

        // dd($reservation);

        $filename = 'Invoice_' . $reservation_code . '.pdf';
        $html = '<h1 style="font-size: 48pt">Hotel<br/>Transylvania</h1>
        <table>
          <tr>
            <td>Kode Reservasi: ' . $reservation->reservation_code . ' <br/> Tanggal: ' . date('Y-m-d') . '</td>
            <td align="right"><h1 style="font-size: 24pt">Invoice</h1></td>
          </tr>
        </table>
        <br/>
        <br/>
        <table border="" cellpadding="5">
            <tr>
                <td>Service</td>
                <td align="center">Price</td>
                <td align="center">Amount</td>
                <td align="center">Total</td>
            </tr>
            <tr>
                <td>' . $reservation->room_type . ' room with ' . $reservation->bed . ' bed</td>
                <td align="center">Rp.' . number_format($reservation->price, 0) . '</td>
                <td align="center">' . $reservation->number_of_days . ' malam</td>
                <td align="center">Rp.' . number_format($reservation->price * $reservation->number_of_days, 0) . '</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Subtotal</td>
                <td width="5%">:</td>
                <td>Rp.' . number_format($reservation->price * $reservation->number_of_days, 0) . '</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Tax</td>
                <td width="5%">:</td>
                <td>Rp.25.000</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Grand total</td>
                <td width="5%">:</td>
                <td>Rp.' . number_format(($reservation->price * $reservation->number_of_days) + 25000, 0) . '</td>
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
