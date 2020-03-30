<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class paket_detailDetailController extends Controller
{
    public function index()
    {
        return view('Master.paket_detail.index');
    }

    public function all()
    {
        $data = paket_detail::all();
        return response()->json($data);
    }

    public function GetById(Request $request)
    {
        $data = paket_detail::where('id_paket_detail', $request->input('id_paket_detail'))->get();
        return response()->json($data);
    }


    public function Insert(Request $request)
    {
        $paket_detail = new paket_detail();

        $this->validation($request);

        $paket_detail->id_penerbangan = $request->input('id_penerbangan');
        $paket_detail->id_hotel = $request->input('id_hotel');
        $paket_detail->id_kamar = $request->input('id_kamar');
        $paket_detail->nama_paket_detail = $request->input('nama_paket_detail');
        $paket_detail->kategori_paket_detail = $request->input('kategori_paket_detail');
        $paket_detail->harga = $request->input('harga');
        $paket_detail->durasi = $request->input('durasi');

        $exec = $paket_detail->save();

        if($exec)
            return response()->json('Berhasil Tambah Data', 200);
        else
            return response()->json('Gagal Tambah Data', 500);
    }

    public function update(Request $request)
    {
        $paket_detail = paket_detail::find($request->input('id_paket_detail'));

        $this->validation($request);

        $paket_detail->id_penerbangan = $request->input('id_penerbangan');
        $paket_detail->id_hotel = $request->input('id_hotel');
        $paket_detail->id_kamar = $request->input('id_kamar');
        $paket_detail->nama_paket_detail = $request->input('nama_paket_detail');
        $paket_detail->kategori_paket_detail = $request->input('kategori_paket_detail');
        $paket_detail->harga = $request->input('harga');
        $paket_detail->durasi = $request->input('durasi');

        $exec = $paket_detail->save();

        if($exec)
            return response()->json('Berhasil Update Data', 200);
        else
            return response()->json('Gagal Update Data', 500);
    }

    public function delete(Request $request)
    {
        $paket_detail = paket_detail::find($request->input('id_paket_detail'));

        $exec = $paket_detail->delete();

        if($exec)
            return response()->json('Berhasil Hapus Data', 200);
        else
            return response()->json('Gagal Hapus Data', 500);
    }
}
