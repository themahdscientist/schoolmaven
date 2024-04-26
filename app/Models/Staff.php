<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grade_id',
        'staff_type',
        'staff_code',
        'position_title',
        'contract_type',
        'contract_expiry_date',
        'marital_status',
        'emergency_phone',
        'salary',
        'bank_details',
        'qualifications',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'bank_details' => 'array',
            'qualifications' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function grade(): HasOne
    {
        return $this->hasOne(Grade::class);
    }

    public function grades(): BelongsToMany
    {
        return $this->belongsToMany(Grade::class);
    }

    public function staffRole(): BelongsTo
    {
        return $this->belongsTo(StaffRole::class);
    }
}
