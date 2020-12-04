<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailed extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'detailed';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'divisi',
        'jabatan',
        'alamat',
        'kota',
        'tmp_lahir',
        'tgl_lahir',
        'tlp',
        'lama_bulan',
    ];

    public function relation()
    {
        return $this->hasOne('App\Models\Employees', 'detail', 'id');
    }
}
