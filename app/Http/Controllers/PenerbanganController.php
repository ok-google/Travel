<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Penerbangan;

class PenerbanganController extends Controller
{
    public function index()
    {
        return view('Master.Penerbangan.index');
    }

    public function all()
    {
        $data = Penerbangan::all();
        return response()->json($data);
    }

    public function GetById(Request $request)
    {
        $data = Penerbangan::where('id_penerbangan', $request->input('id_penerbangan'))->get();
        return response()->json($data);
    }

    public function Validation(Request $request)
    {
        if(is_null($request->input('id_penerbangan'))){
            $id_penerbangan = '0';
        } else {
            $id_penerbangan = $request->input('id_penerbangan');
        }

        $rules = [
            'kode_penerbangan' => 'required|unique:Penerbangan,kode_penerbangan,'.$id_penerbangan.',id_penerbangan',
            'nama_penerbangan' => 'required'
        ];

        $messages = [
            'kode_penerbangan.required' => 'Kode Penerbangan harus di isi.',
            'kode_penerbangan.unique' => 'Kode Penerbangan tidak boleh sama',
            'nama_penerbangan.required' => 'Nama Penerbangan harus di isi.'
        ];

        $this->validate($request, $rules, $messages);
    }

    public function Insert(Request $request)
    {
        $Penerbangan = new Penerbangan();

        $this->validation($request);

        $Penerbangan->kode_penerbangan = $request->input('kode_penerbangan');
        $Penerbangan->nama_penerbangan = $request->input('nama_penerbangan');
        $Penerbangan->Keterangan = (is_null($request->input('Keterangan')) ? "" : $request->input('Keterangan'));
        $Penerbangan->Aktif = 1;

        $exec = $Penerbangan->save();

        if($exec)
            return response()->json('Berhasil Tambah Data', 200);
        else
            return response()->json('Gagal Tambah Data', 500);
    }

    public function update(Request $request)
    {
        $Penerbangan = Penerbangan::find($request->input('id_penerbangan'));

        $this->validation($request);

        $Penerbangan->kode_penerbangan = $request->input('kode_penerbangan');
        $Penerbangan->nama_penerbangan = $request->input('nama_penerbangan');
        $Penerbangan->Keterangan = (is_null($request->input('Keterangan')) ? "" : $request->input('Keterangan'));
        $Penerbangan->Aktif = 1;

        $exec = $Penerbangan->save();

        if($exec)
            return response()->json('Berhasil Update Data', 200);
        else
            return response()->json('Gagal Update Data', 500);
    }

    public function delete(Request $request)
    {
        $Penerbangan = Penerbangan::find($request->input('id_penerbangan'));

        $exec = $Penerbangan->delete();

        if($exec)
            return response()->json('Berhasil Hapus Data', 200);
        else
            return response()->json('Gagal Hapus Data', 500);
    }
}
