<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sutartys extends Model
{
    public $timestamps = false;

    protected $attributes = [
        'yra_archyvuota' => false
    ];

    protected $fillable = [
        'vartotojo_id',
        'keliones_nr',
        'viesbucio_id',
        'sudarymo_data',
        'bendra_kaina',
        'busena',
        'zmoniu_sk'
    ];
}
