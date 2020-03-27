<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kamar extends Model
{
    protected $table = "kamar";
    protected $primaryKey = 'id_kamar';
    protected $fillable = ['id_hotel',
                           'kelas_kamar',
                           'jml_bed',
                           'harga'
                        ];
    public $timestamps = false;
}
