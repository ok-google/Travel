<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kamar;

class KamarController extends Controller
{
    public function index()
    {
        return view('Master.kamar.index');
    }

    public function all()
    {
        $data = kamar::leftJoin('hotel', function($join){
                    $join->on('hotel.id_hotel', '=', 'kamar.id_hotel');
                })->get([
                    'kamar.kelas_kamar', 'kamar.jml_bed', 'kamar.harga', 'kamar.aktif', 'hotel.nama_hotel', 'kamar.id_kamar'
                ])->map(function ($kamar){
                    $kamar->harga = number_format($kamar->harga, 2);

                    return $kamar;
                });
        return response()->json($data);
    }

    public function selectAktif()
    {
        $data = kamar::where('aktif', 1)->get();
        return response()->json($data);
    }

    public function getById(Request $request)
    {
        $data = kamar::where('id_kamar', $request->input('id_kamar'))->get();
        return response()->json($data);
    }

    public function validation(Request $request)
    {
        if(is_null($request->input('id_kamar'))){
            $id_kamar = '0';
        } else {
            $id_kamar = $request->input('id_kamar');
        }

        $rules = [
            'id_hotel' => 'required',
            'kelas_kamar' => 'required',
            'jml_bed' => 'required',
            'harga' => 'required'
        ];

        $messages = [
            'id_hotel.requires' => 'Hotel harus di isi',
            'kelas_kamar.required' => 'Kelas kamar harus di isi',
            'jml_bed.required' => 'Jumlah Bed harus di isi',
            'harga.required' => 'Harga harus di isi.'
        ];

        $this->validate($request, $rules, $messages);
    }

    public function insert(Request $request)
    {
        $kamar = new kamar();

       $this->validation($request);

        $kamar->id_hotel = $request->input('id_hotel');
        $kamar->kelas_kamar = $request->input('kelas_kamar');
        $kamar->jml_bed = $request->input('jml_bed');
        $kamar->harga = $request->input('harga');
        $kamar->aktif = $request->input('aktif');

        $exec = $kamar->save();

        if($exec)
            return response()->json('Berhasil Tambah Data', 200);
        else
            return response()->json('Gagal Tambah Data', 500);
    }

    public function update(Request $request)
    {
        $kamar = kamar::find($request->input('id_kamar'));

        $this->validation($request);

        $kamar->id_hotel = $request->input('id_hotel');
        $kamar->kelas_kamar = $request->input('kelas_kamar');
        $kamar->jml_bed = $request->input('jml_bed');
        $kamar->harga = $request->input('harga');
        $kamar->aktif = $request->input('aktif');

        $exec = $kamar->save();

        if($exec)
            return response()->json('Berhasil Update Data', 200);
        else
            return response()->json('Gagal Update Data', 500);
    }

    public function delete(Request $request)
    {
        $kamar = kamar::find($request->input('id_kamar'));

        $exec = $kamar->delete();

        if($exec)
            return response()->json('Berhasil Hapus Data', 200);
        else
            return response()->json('Gagal Hapus Data', 500);
    }
}
