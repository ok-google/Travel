<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\pembayaran;

class PembayaranController extends Controller
{
     public function index()
    {
        return view('Transaksi.pembayaran.index');
    }

    public function all()
    {
        $query = '';

        $query = "SELECT bayar.tgl_pembayaran, bayar.bukti_pembayaran, bayar.nominal,
				       book.kd_booking, cust.nama, hotel.nama_hotel, kamar.kelas_kamar, penerbangan.nama_penerbangan,
				       brgkt.tgl_berangkat, brgkt.tgl_pulang, paket.harga
					FROM pembayaran bayar
				    LEFT OUTER JOIN booking book ON (bayar.id_booking = book.id_booking)
				    LEFT OUTER JOIN paket ON (paket.id_paket = book.id_paket)
				    LEFT OUTER JOIN customer cust ON (cust.id_customer = book.id_customer)
				    LEFT OUTER JOIN hotel ON (paket.id_hotel = hotel.id_hotel)
				    LEFT OUTER JOIN kamar ON (paket.id_kamar = kamar.id_kamar)
				    LEFT OUTER JOIN penerbangan ON (paket.id_penerbangan = penerbangan.id_penerbangan)
				    LEFT OUTER JOIN keberangkatan brgkt ON (brgkt.id_keberangkatan = book.id_keberangkatan)";

		$data = DB::select($query);	


        return response()->json($data);
    }

    public function selectAktif()
    {
        $data = pembayaran::where('aktif', 1)->get();
        return response()->json($data);
    }

    public function getById(Request $request)
    {
        $data = pembayaran::where('id_pembayaran', $request->input('id_pembayaran'))->get();
        return response()->json($data);
    }

    public function validation(Request $request)
    {
        if(is_null($request->input('id_pembayaran'))){
            $id_pembayaran = '0';
        } else {
            $id_pembayaran = $request->input('id_pembayaran');
        }

        $rules = [
            'id_booking' => 'required',
            'tgl_pembayaran' => 'required',
            'bukti_pembayaran' => 'required',
            'nominal' => 'requiresred',
            'file' => 'required'
        ];

        $messages = [
            'id_booking.requires' => 'ID Booking harus di isi',
            'tgl_pembayaran.required' => 'Tanggal Pembayaran harus di isi',
            'bukti_pembayaran.required' => 'Bukti Pembayaran harus di isi',
            'nominal.required' => 'Nominal harus di isi.',
            'file.requires' => 'File harus di isi'
        ];

        $this->validate($request, $rules, $messages);
    }

    public function insert(Request $request)
    {
        $pembayaran = new pembayaran();

    	$this->validation($request);

        $pembayaran->kd_pembayaran = $request->input('kd_pembayaran');
        $pembayaran->id_paket = $request->input('id_paket');
        $pembayaran->id_customer = $request->input('id_customer');
        $pembayaran->id_keberangkatan = $request->input('id_keberangkatan');
        $pembayaran->nomor_tiket = $request->input('nomor_tiket');
        $pembayaran->nomor_kamar = $request->input('nomor_kamar');
        $pembayaran->tgl_pembayaran = $request->input('tgl_pembayaran');
        $pembayaran->aktif = $request->input('aktif');
        $pembayaran->tgl_batal = $request->input('tgl_batal');

        $exec = $pembayaran->save();

        if($exec)
            return response()->json('Berhasil Tambah Data', 200);
        else
            return response()->json('Gagal Tambah Data', 500);
    }

    public function update(Request $request)
    {
        $pembayaran = pembayaran::find($request->input('id_pembayaran'));

        $this->validation($request);
		
		$pembayaran->kd_pembayaran = $request->input('kd_pembayaran');
        $pembayaran->id_paket = $request->input('id_paket');
        $pembayaran->id_customer = $request->input('id_customer');
        $pembayaran->id_keberangkatan = $request->input('id_keberangkatan');
        $pembayaran->nomor_tiket = $request->input('nomor_tiket');
        $pembayaran->nomor_kamar = $request->input('nomor_kamar');
        $pembayaran->tgl_pembayaran = $request->input('tgl_pembayaran');
        $pembayaran->aktif = $request->input('aktif');
        $pembayaran->tgl_batal = $request->input('tgl_batal');

        $exec = $pembayaran->save();

        if($exec)
            return response()->json('Berhasil Update Data', 200);
        else
            return response()->json('Gagal Update Data', 500);
    }

    public function delete(Request $request)
    {
        $pembayaran = pembayaran::find($request->input('id_pembayaran'));

        $exec = $pembayaran->delete();

        if($exec)
            return response()->json('Berhasil Hapus Data', 200);
        else
            return response()->json('Gagal Hapus Data', 500);
    }}
