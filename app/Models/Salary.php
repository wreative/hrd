<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'salary';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'plus_id',
        'minus_id',
        'e_id',
        'gaji',
        'penerimaan',
        'pengurangan',
        'total'
    ];

    public function relationEmployees()
    {
        return $this->hasOne('App\Models\Employees', 'id', 'e_id');
    }

    public function relationSalaryMinus()
    {
        return $this->belongsTo('App\Models\SalaryMinus', 'minus_id', 'id_minus');
    }

    public function relationSalaryPlus()
    {
        return $this->belongsTo('App\Models\SalaryPlus', 'plus_id', 'id_plus');
    }
}
