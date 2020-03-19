<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penerbangan extends Model
{
    protected $table = "Penerbangan";
    protected $primaryKey = 'id_penerbangan';
    protected $fillable = ['kode_penerbangan',
                           'nama_penerbangan',
                           'aktif',
                           'keterangan'
                        ];
    public $timestamps = false;
}
