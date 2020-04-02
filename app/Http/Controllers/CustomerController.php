<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\customer;

class CustomerController extends Controller
{
     public function index()
    {
        return view('Master.customer.index');
    }

    public function all()
    {
        $data = customer::get()
                        ->map(function ($Customer) {
                                    $Customer->tgl_lahir = date("d-m-Y", strtotime($Customer->tgl_lahir));
                                    if($Customer->jenis_kelamin == 1){
                                        $Customer->jenis_kelamin = 'Pria';
                                    } else {
                                        $Customer->jenis_kelamin = 'Wanita';
                                    }
                                    return $Customer;
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
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required',
        ];

        $messages = [
            'nama.required' => 'Nama customer harus di isi',
            'alamat.required' => 'Alamat Bed harus di isi',
            'no_hp.required' => 'NO HP harus di isi.',
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

        $customer->id_user = 0;
        $customer->nama = $request->input('nama');
        $customer->alamat = $request->input('alamat');
        $customer->no_hp = $request->input('no_hp');
        $customer->email = $request->input('email');
        $customer->jenis_kelamin = $request->input('jenis_kelamin');
        $customer->tgl_lahir = date("Y-m-d", strtotime($request->input('tgl_lahir')));

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

        $customer->id_user = 0;
        $customer->nama = $request->input('nama');
        $customer->alamat = $request->input('alamat');
        $customer->no_hp = $request->input('no_hp');
        $customer->email = $request->input('email');
        $customer->jenis_kelamin = $request->input('jenis_kelamin');
        $customer->tgl_lahir = date("Y-m-d", strtotime($request->input('tgl_lahir')));

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