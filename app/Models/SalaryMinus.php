<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryMinus extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'salary_minus';
    protected $primaryKey = 'id_minus';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'telat',
        'tdk_hdr_a',
        'tdk_hdr_s',
        'tdk_hdr_i',
        'tdk_hdr_b',
        'ka',
        'ik',
        'tk',
        't1',
        't2',
        't3',
        't4',
        'ak'
    ];

    public function relation()
    {
        return $this->hasOne('App\Models\Salary', 'minus_id', 'id_minus');
    }
}
