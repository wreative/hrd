<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryPlus extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'salary_plus';
    protected $primaryKey = 'id_plus';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'gaji_pkk',
        'uang_hdr',
        'tnjgn_trpi',
        'lmbr_m',
        'lmbr_h',
        'lmbr_l',
        'lmbr_p_m',
        'lmbr_p_l',
        'hdr_lk',
        'lmbr_lk',
        'lylts',
        'ddks'
    ];

    public function relation()
    {
        return $this->hasOne('App\Models\Salary', 'plus_id', 'id_plus');
    }
}
