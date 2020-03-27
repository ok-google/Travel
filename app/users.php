<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = "users";
    protected $primaryKey = 'id_user';
    protected $fillable = ['username',
                           'password',
                           'level'
                        ];
    public $timestamps = false;
}
