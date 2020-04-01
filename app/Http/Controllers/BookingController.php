<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
     public function index()
    {
        return view('Master.booking.index');
    }

    public function all()
    {
        $data = booking::leftJoin('paket', function($join){
                    $join->on('paket.id_paket', '=', 'booking.id_paket');
                })->get([
                    'booking.kd_booking', 'booking.id_customer', 'booking.id_keberangkatan', 'booking.nomor_tiket', 'hotel.nomor_kamar', 'booking.tgl_booking', 'booking.aktif', 'booking.tgl_batal'
                ])->map(function ($booking){
                    $booking->harga = number_format($booking->harga, 2);

                    return $booking;
                });
        return response()->json($data);
    }

    public function selectAktif()
    {
        $data = booking::where('aktif', 1)->get();
        return response()->json($data);
    }

    public function getById(Request $request)
    {
        $data = booking::where('id_booking', $request->input('id_booking'))->get();
        return response()->json($data);
    }

    public function validation(Request $request)
    {
        if(is_null($request->input('id_booking'))){
            $id_booking = '0';
        } else {
            $id_booking = $request->input('id_booking');
        }

        $rules = [
            'kd_booking' => 'required',
            'id_paket' => 'required',
            'id_customer' => 'required',
            'id_keberangkatan' => 'requiresred',
            'nomor_tiket' => 'required',
            'nomor_kamar' => 'required',
            'tgl_booking' => 'required',
            'tgl_batal' => 'required'
        ];

        $messages = [
            'kd_booking.requires' => 'Kode Booking harus di isi',
            'id_paket.required' => 'ID Paket harus di isi',
            'id_customer.required' => 'ID Customer harus di isi',
            'id_keberangkatan.required' => 'ID Keberangkatan harus di isi.',
            'nomor_tiket.requires' => 'Nomer Tiket harus di isi',
            'nomor_kamar.required' => 'Nomor Kamar harus di isi',
            'tgl_booking.required' => 'Tanggal Booking harus di isi',
            'tgl_batal.required' => 'Tanggal Batal harus di isi.'
        ];

        $this->validate($request, $rules, $messages);
    }

    public function insert(Request $request)
    {
        $booking = new booking();

       $this->validation($request);

        $booking->kd_booking = $request->input('kd_booking');
        $booking->id_paket = $request->input('id_paket');
        $booking->id_customer = $request->input('id_customer');
        $booking->id_keberangkatan = $request->input('id_keberangkatan');
        $booking->nomor_tiket = $request->input('nomor_tiket');
        $booking->nomor_kamar = $request->input('nomor_kamar');
        $booking->tgl_booking = $request->input('tgl_booking');
        $booking->aktif = $request->input('aktif');
        $booking->tgl_batal = $request->input('tgl_batal');

        $exec = $booking->save();

        if($exec)
            return response()->json('Berhasil Tambah Data', 200);
        else
            return response()->json('Gagal Tambah Data', 500);
    }

    public function update(Request $request)
    {
        $booking = booking::find($request->input('id_booking'));

        $this->validation($request);
		
		$booking->kd_booking = $request->input('kd_booking');
        $booking->id_paket = $request->input('id_paket');
        $booking->id_customer = $request->input('id_customer');
        $booking->id_keberangkatan = $request->input('id_keberangkatan');
        $booking->nomor_tiket = $request->input('nomor_tiket');
        $booking->nomor_kamar = $request->input('nomor_kamar');
        $booking->tgl_booking = $request->input('tgl_booking');
        $booking->aktif = $request->input('aktif');
        $booking->tgl_batal = $request->input('tgl_batal');

        $exec = $booking->save();

        if($exec)
            return response()->json('Berhasil Update Data', 200);
        else
            return response()->json('Gagal Update Data', 500);
    }

    public function delete(Request $request)
    {
        $booking = booking::find($request->input('id_booking'));

        $exec = $booking->delete();

        if($exec)
            return response()->json('Berhasil Hapus Data', 200);
        else
            return response()->json('Gagal Hapus Data', 500);
    }
}
