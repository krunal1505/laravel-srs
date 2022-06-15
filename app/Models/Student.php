<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'dob',
        'passport',
        'address1',
        'address2',
        'country_id',
        'state_id',
        'city',
        'postal_cod e',
        'user_type',
        'created_by',
        'is_private',
    ];
}
