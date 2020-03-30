<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\keberangkatan;


class KeberangkatanController extends Controller
{
    public function index()
    {
        return view('Master.keberangkatan.index');
    }

    public function all()
    {
        $data = keberangkatan::all();
        return response()->json($data);
    }

    public function GetById(Request $request)
    {
        $data = keberangkatan::where('id_keberangkatan', $request->input('id_keberangkatan'))->get();
        return response()->json($data);
    }

    public function Validation(Request $request)
    {
        if(is_null($request->input('id_keberangkatan'))){
            $id_keberangkatan = '0';
        } else {
            $id_keberangkatan = $request->input('id_keberangkatan');
        }

        $rules = [
            'tgl_berangkat' => 'required';
            'tgl_pulang' => 'required';
        ];

        $messages = [
            'tgl_berangkat.required' => 'tanggal berangkat harus di isi.',
            'tgl_pulang.required' => 'tanggal pulang harus di isi'
        ];

        $this->validate($request, $rules, $messages);
    }

    public function Insert(Request $request)
    {
        $keberangkatan = new keberangkatan();

        $this->validation($request);

        $keberangkatan->tgl_berangkat = $request->input('tgl_berangkat');
        $keberangkatan->tgl_pulang = $request->input('tgl_pulang');

        $exec = $keberangkatan->save();

        if($exec)
            return response()->json('Berhasil Tambah Data', 200);
        else
            return response()->json('Gagal Tambah Data', 500);
    }

    public function update(Request $request)
    {
        $keberangkatan = keberangkatan::find($request->input('id_keberangkatan'));

        $this->validation($request);

        $keberangkatan->tgl_berangkat = $request->input('tgl_berangkat');
        $keberangkatan->tgl_pulang = $request->input('tgl_pulang');

        $exec = $keberangkatan->save();

        if($exec)
            return response()->json('Berhasil Update Data', 200);
        else
            return response()->json('Gagal Update Data', 500);
    }

    public function delete(Request $request)
    {
        $keberangkatan = keberangkatan::find($request->input('id_keberangkatan'));

        $exec = $keberangkatan->delete();

        if($exec)
            return response()->json('Berhasil Hapus Data', 200);
        else
            return response()->json('Gagal Hapus Data', 500);
    }
}
