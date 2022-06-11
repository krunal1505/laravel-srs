<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'address1',
        'address2',
        'country_id',
        'province_id',
        'city',
        'website'
    ];
}
