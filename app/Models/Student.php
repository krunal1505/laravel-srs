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
        'passport_number',
        'address1',
        'address2',
        'country_id',
        'state_id',
        'city',
        'postal_code',
        'program_id',
        'intake_id',
        'passport',
        'ielts',
        'education_documents',
        'study_permit',
        'notes',
        'user_type',
        'status',
        'created_by',
        'is_private',
    ];
}
