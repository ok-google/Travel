<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
     public function index()
    {
        return view('Master.customer.index');
    }

    public function all()
    {
        $data = customer::leftJoin('user', function($join){
                    $join->on('user.id_user', '=', 'customer.id_user');
                })->get([
                    'customer.nama', 'customer.alamat', 'customer.no_hp', 'customer.email', 'hotel.jenis_kelamin', 'customer.tgl_lahir'
                ])->map(function ($customer){
                    $customer->harga = number_format($customer->harga, 2);

                    return $customer;
                });
        return response()->json($data);
    }

    public function selectAktif()
    {
        $data = customer::where('aktif', 1)->get();
        return response()->json($data);
    }

    public function getById(Request $request)
    {
        $data = customer::where('id_customer', $request->input('id_customer'))->get();
        return response()->json($data);
    }

    public function validation(Request $request)
    {
        if(is_null($request->input('id_customer'))){
            $id_customer = '0';
        } else {
            $id_customer = $request->input('id_customer');
        }

        $rules = [
            'id_user' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required',
        ];

        $messages = [
            'id_user.requires' => 'ID User harus di isi',
            'nama.required' => 'Nama customer harus di isi',
            'alamat.required' => 'Alamat Bed harus di isi',
            'no_hp.required' => 'NO HP harus di isi.'
            'email.required' => 'Email customer harus di isi',
            'jenis_kelamin.required' => 'Jenis Kelamin Bed harus di isi',
            'tgl_lahir.required' => 'Tanggal Lahir harus di isi.'
        ];

        $this->validate($request, $rules, $messages);
    }

    public function insert(Request $request)
    {
        $customer = new customer();

       $this->validation($request);

        $customer->id_user = $request->input('id_user');
        $customer->nama = $request->input('nama');
        $customer->alamat = $request->input('alamat');
        $customer->no_hp = $request->input('no_hp');
        $customer->email = $request->input('email');
        $customer->jenis_kelamin = $request->input('jenis_kelamin');
        $customer->tgl_lahir = $request->input('tgl_lahir');

        $exec = $customer->save();

        if($exec)
            return response()->json('Berhasil Tambah Data', 200);
        else
            return response()->json('Gagal Tambah Data', 500);
    }

    public function update(Request $request)
    {
        $customer = customer::find($request->input('id_customer'));

        $this->validation($request);

        $customer->id_user = $request->input('id_user');
        $customer->nama = $request->input('nama');
        $customer->alamat = $request->input('alamat');
        $customer->no_hp = $request->input('no_hp');
        $customer->email = $request->input('email');
        $customer->jenis_kelamin = $request->input('jenis_kelamin');
        $customer->tgl_lahir = $request->input('tgl_lahir');

        $exec = $customer->save();

        if($exec)
            return response()->json('Berhasil Update Data', 200);
        else
            return response()->json('Gagal Update Data', 500);
    }

    public function delete(Request $request)
    {
        $customer = customer::find($request->input('id_customer'));

        $exec = $customer->delete();

        if($exec)
            return response()->json('Berhasil Hapus Data', 200);
        else
            return response()->json('Gagal Hapus Data', 500);
    }
}