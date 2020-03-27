<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    protected $table = "pembayaran";
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = ['id_booking',
                           'tgl_pembayaran',
                           'bukti_pembayaran',
                           'nominal',
                           'file'
                        ];
    public $timestamps = false;
}
