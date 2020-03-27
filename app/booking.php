<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{

    protected $table = "booking";
    protected $primaryKey = 'id_booking';
    protected $fillable = ['kd_booking',
                           'id_paket',
                           'id_customer',
                           'id_keberangkatan',
                           'nomor_tiket',
                           'nomor_kamar',
                           'tgl_booking',
                           'aktif',
                           'tgl_batal'
                        ];
    public $timestamps = false;

}
