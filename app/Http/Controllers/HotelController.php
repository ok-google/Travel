<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hotel;

class HotelController extends Controller
{
    public function index()
    {
        return view('Master.hotel.index');
    }

    public function all()
    {
        $data = hotel::all();
        return response()->json($data);
    }

    public function getById(Request $request)
    {
        $data = hotel::where('id_hotel', $request->input('id_hotel'))->get();
        return response()->json($data);
    }

    public function validation(Request $request)
    {
        if(is_null($request->input('id_hotel'))){
            $id_hotel = '0';
        } else {
            $id_hotel = $request->input('id_hotel');
        }

        $rules = [
            'email' => 'required|unique:hotel,email,'.$id_hotel.',id_hotel',
            'telp' => 'required|unique:hotel,telp,'.$id_hotel.',id_hotel',
            'nama_hotel' => 'required'
        ];

        $messages = [
            'email.unique' => 'Kode hotel tidak boleh sama',
            'email.required' => 'Kode hotel harus di isi',
            'telp.unique' => 'Nomor Telepon hotel tidak boleh sama',
            'telp.required' => 'Nomor Telepon hotel harus di isi',
            'nama_hotel.required' => 'Nama hotel harus di isi.'
        ];

        $this->validate($request, $rules, $messages);
    }

    public function insert(Request $request)
    {
        $hotel = new hotel();

        $this->validation($request);
        $hotel->nama_hotel = $request->input('nama_hotel');
        $hotel->alamat = $request->input('alamat');
        $hotel->kota = $request->input('kota');
        $hotel->aktif = $request->input('aktif');
        $hotel->telp = $request->input('telp');
        $hotel->email = $request->input('email');

        $exec = $hotel->save();

        if($exec)
            return response()->json('Berhasil Tambah Data', 200);
        else
            return response()->json('Gagal Tambah Data', 500);
    }

    public function update(Request $request)
    {
        $hotel = hotel::find($request->input('id_hotel'));

        $this->validation($request);
        $hotel->nama_hotel = $request->input('nama_hotel');
        $hotel->alamat = $request->input('alamat');
        $hotel->kota = $request->input('kota');
        $hotel->aktif = $request->input('aktif');
        $hotel->telp = $request->input('telp');
        $hotel->email = $request->input('email');

        $exec = $hotel->save();

        if($exec)
            return response()->json('Berhasil Update Data', 200);
        else
            return response()->json('Gagal Update Data', 500);
    }

    public function delete(Request $request)
    {
        $hotel = hotel::find($request->input('id_hotel'));

        $exec = $hotel->delete();

        if($exec)
            return response()->json('Berhasil Hapus Data', 200);
        else
            return response()->json('Gagal Hapus Data', 500);
    }
}
