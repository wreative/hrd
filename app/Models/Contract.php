<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'contract';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'tgl_masuk',
        'akhir_kontrak',
        'gaji',
        'no_jaminan',
        'jenis_jaminan'
    ];

    public function relation()
    {
        return $this->hasOne('App\Models\Employees', 'kontrak', 'id');
    }
}
