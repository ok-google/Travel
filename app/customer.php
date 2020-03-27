<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $table = "customers";
    protected $primaryKey = 'id_customer';
    protected $fillable = ['id_user',
                           'nama',
                           'alamat',
                           'no_hp',
                           'email',
                           'jenis_kelamin',
                           'tgl_lahir'
                        ];
    public $timestamps = false;
}
