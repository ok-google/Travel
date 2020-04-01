<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paket extends Model
{
    protected $table = "paket";
    protected $primaryKey = 'id_paket';
    protected $fillable = ['id_penerbangan',
                           'id_hotel',
                           'id_kamar',
                           'nama_paket',
                           'kategori_paket',
                           'harga',
                           'durasi',
                           'aktif'
                        ];
    public $timestamps = false;
}
