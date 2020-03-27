<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hotel extends Model
{
    protected $table = "hotel";
    protected $primaryKey = 'id_hotel';
    protected $fillable = ['nama_hotel',
                           'alamat',
                           'kota',
                           'aktif',
                           'telp',
                           'email'
                        ];
    public $timestamps = false;
}
