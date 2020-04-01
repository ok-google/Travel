<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keberangkatan extends Model
{

    protected $table = "keberangkatan";
    protected $primaryKey = 'id_keberangkatan';
    protected $fillable = ['tgl_berangkat',
                           'tgl_pulang'
                        ];
    public $timestamps = false;
}
