<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto_nuomos extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'sutarties_nr',
        'pradzios_data',
        'pabaigos_data',
        'bendra_kaina'
    ];
}
