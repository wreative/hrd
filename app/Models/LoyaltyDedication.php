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
        'e_id',
        'loyalitas',
        'dedikasi'
    ];

    public function relationEmployees()
    {
        return $this->belongsTo('App\Models\Employees', 'e_id', 'id');
    }

    public function relationLoyalty()
    {
        return $this->belongsTo('App\Models\Loyalty', 'l_id', 'id');
    }

    public function relationDedication()
    {
        return $this->belongsTo('App\Models\Dedication', 'd_id', 'id');
    }
}
