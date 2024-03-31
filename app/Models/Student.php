<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grade_id',
        'section_id',
        'guardian_id',
        'admission_number',
        'enrollment_date',
        'nationality',
        'address',
        'religion',
        'blood_group',
        'rhesus_factor',
        'emergency_contact',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }
}
