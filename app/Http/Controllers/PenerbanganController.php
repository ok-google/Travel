<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\penerbangan;

class penerbanganController extends Controller
{
    public function index()
    {
        return view('Master.penerbangan.index');
    }

    public function all()
    {
        $data = penerbangan::all();
        return response()->json($data);
    }

    public function getById(Request $request)
    {
        $data = penerbangan::where('id_penerbangan', $request->input('id_penerbangan'))->get();
        return response()->json($data);
    }

    public function validation(Request $request)
    {
        if(is_null($request->input('id_penerbangan'))){
            $id_penerbangan = '0';
        } else {
            $id_penerbangan = $request->input('id_penerbangan');
        }

        $rules = [
            'kode_penerbangan' => 'required|unique:penerbangan,kode_penerbangan,'.$id_penerbangan.',id_penerbangan',
            'nama_penerbangan' => 'required'
        ];

        $messages = [
            'kode_penerbangan.unique' => 'Kode Penerbangan tidak boleh sama',
            'kode_penerbangan.required' => 'Kode Penerbangan harus di isi',
            'nama_penerbangan.required' => 'Nama penerbangan harus di isi.'
        ];

        $this->validate($request, $rules, $messages);
    }

    public function insert(Request $request)
    {
        $penerbangan = new penerbangan();

        $this->validation($request);
        $penerbangan->kode_penerbangan = $request->input('kode_penerbangan');
        $penerbangan->nama_penerbangan = $request->input('nama_penerbangan');
        $penerbangan->Keterangan = (is_null($request->input('Keterangan')) ? "" : $request->input('Keterangan'));
        $penerbangan->Aktif = $request->input('aktif');

        $exec = $penerbangan->save();

        if($exec)
            return response()->json('Berhasil Tambah Data', 200);
        else
            return response()->json('Gagal Tambah Data', 500);
    }

    public function update(Request $request)
    {
        $penerbangan = penerbangan::find($request->input('id_penerbangan'));

        $this->validation($request);
        $penerbangan->kode_penerbangan = $request->input('kode_penerbangan');
        $penerbangan->nama_penerbangan = $request->input('nama_penerbangan');
        $penerbangan->Keterangan = (is_null($request->input('Keterangan')) ? "" : $request->input('Keterangan'));
        $penerbangan->Aktif = $request->input('aktif');

        $exec = $penerbangan->save();

        if($exec)
            return response()->json('Berhasil Update Data', 200);
        else
            return response()->json('Gagal Update Data', 500);
    }

    public function delete(Request $request)
    {
        $penerbangan = penerbangan::find($request->input('id_penerbangan'));

        $exec = $penerbangan->delete();

        if($exec)
            return response()->json('Berhasil Hapus Data', 200);
        else
            return response()->json('Gagal Hapus Data', 500);
    }
}
