<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'employees';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'nik',
        'kode',
        'nama',
        'jk',
        'photo',
        'status',
        'keterangan',
        'rek',
        'detail',
        'kontrak',
        'ld'
    ];

    public function relationContract()
    {
        return $this->belongsTo('App\Models\Contract', 'kontrak', 'id');
    }

    public function relationDetailed()
    {
        return $this->belongsTo('App\Models\Detailed', 'detail', 'id');
    }

    public function relationSalary()
    {
        return $this->belongsTo('App\Models\Salary', 'id', 'e_id');
    }

    public function relationLoyaltyDedication()
    {
        return $this->belongsTo('App\Models\LoyaltyDedication', 'e_id', 'ld_id');
    }
}
