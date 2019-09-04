<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    protected $table = 'sub_kriteria';

    protected $primaryKey = 'kd_sub';

    protected $fillable = [
        'kd_sub',
        'nama_sub',
        'kd_kriteria'
    ];

    public $incrementing = false;
}
