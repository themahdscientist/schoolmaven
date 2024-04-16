<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staff extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'qualifications' => 'array',
        ];
    }

    public function teachingStaff(): HasOne
    {
        return $this->hasOne(TeachingStaff::class);
    }

    public function nonTeachingStaff(): HasOne
    {
        return $this->hasOne(NonTeachingStaff::class);
    }
}
