<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        return view('Master.paket.index');
    }

    public function all()
    {
        $data = paket::all();
        return response()->json($data);
    }

    public function GetById(Request $request)
    {
        $data = paket::where('id_paket', $request->input('id_paket'))->get();
        return response()->json($data);
    }

    public function Validation(Request $request)
    {
        if(is_null($request->input('id_paket'))){
            $id_paket = '0';
        } else {
            $id_paket = $request->input('id_paket');
        }

        $rules = [
        	'id_penerbangan' => 'required';
        	'id_hotel' => 'required';
        	'id_kamar' => 'required';
        	'nama_paket' => 'required';
        	'kategori_paket' => 'required';
        	'harga' => 'required';
        	'durasi' => 'required';
        ];

        $messages = [
        	'id_penerbangan' => 'id penerbangan harus di isi',
        	'id_hotel' => 'id hotel harus di isi',
        	'id_kamar' => 'id penerbangan harus di isi',
        	'nama_paket' => 'id kamar harus di isi',
        	'kategori_paket' => 'kategori paket harus di isi',
        	'harga' => 'harga harus di isi',
        	'durasi' => 'durasi harus di isi'

        $this->validate($request, $rules, $messages);
    }

    public function Insert(Request $request)
    {
        $paket = new paket();

        $this->validation($request);

        $paket->id_penerbangan = $request->input('id_penerbangan');
        $paket->id_hotel = $request->input('id_hotel');
        $paket->id_kamar = $request->input('id_kamar');
        $paket->nama_paket = $request->input('nama_paket');
        $paket->kategori_paket = $request->input('kategori_paket');
        $paket->harga = $request->input('harga');
        $paket->durasi = $request->input('durasi');
        $paket->aktif = 1;

        $exec = $paket->save();

        if($exec)
            return response()->json('Berhasil Tambah Data', 200);
        else
            return response()->json('Gagal Tambah Data', 500);
    }

    public function update(Request $request)
    {
        $paket = paket::find($request->input('id_paket'));

        $this->validation($request);

        $paket->id_penerbangan = $request->input('id_penerbangan');
        $paket->id_hotel = $request->input('id_hotel');
        $paket->id_kamar = $request->input('id_kamar');
        $paket->nama_paket = $request->input('nama_paket');
        $paket->kategori_paket = $request->input('kategori_paket');
        $paket->harga = $request->input('harga');
        $paket->durasi = $request->input('durasi');
        $paket->aktif = 1;

        $exec = $paket->save();

        if($exec)
            return response()->json('Berhasil Update Data', 200);
        else
            return response()->json('Gagal Update Data', 500);
    }

    public function delete(Request $request)
    {
        $paket = paket::find($request->input('id_paket'));

        $exec = $paket->delete();

        if($exec)
            return response()->json('Berhasil Hapus Data', 200);
        else
            return response()->json('Gagal Hapus Data', 500);
    }
}
