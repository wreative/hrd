<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loyalty extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'loyalty';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'amanah',
        'produktif',
        'tw',
        'total',
    ];

    public function relationLoyaltyDedication()
    {
        return $this->hasOne('App\Models\LoyaltyDedication', 'id', 'l_id');
    }
}
