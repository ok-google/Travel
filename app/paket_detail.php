<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paket_detail extends Model
{
    protected $table = "paket_detail";
    protected $primaryKey = 'id_paket_detail';
    protected $fillable = ['id_paket',
                           'id_keberangkatan',
                           'aktif',
                           'keterangan',
                        ];
    public $timestamps = false;
}
