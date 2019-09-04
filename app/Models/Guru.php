<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $primaryKey = 'kd_guru';

    protected $fillable = [
        'kd_guru',
        'nama_guru',
        'jenkel',
        'no_telp',
        'alamat'
    ];

    public $incrementing = false;
}
