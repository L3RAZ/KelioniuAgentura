<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sutartys_ekskursijos extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'ekskursijos_nr',
        'sutarties_nr'
    ];
}
