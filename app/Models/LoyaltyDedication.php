<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyDedication extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'ld';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'tgl',
        'rank',
        'd_id',
        'l_id',
        'loyalitas',
        'dedikasi'
    ];

    public function relationEmployees()
    {
        return $this->hasOne('App\Models\Employees', 'id', 'ld_id');
    }

    public function relationLoyalty()
    {
        return $this->belongsTo('App\Models\Loyalty', 'id', 'l_id');
    }

    public function relationDedication()
    {
        return $this->belongsTo('App\Models\Dedication', 'id', 'id', 'd_id');
    }
}
