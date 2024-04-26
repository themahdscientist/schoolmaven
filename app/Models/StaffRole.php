<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StaffRole extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class);
    }

    const TEACHING_STAFF = 1;

    const NON_TEACHING_STAFF = 2;
}
