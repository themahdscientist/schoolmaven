<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'smil_code',
        'name',
        'alias',
        'address',
        'lga',
        'state',
        'postal_code',
        'country',
        'contact_info',
        'accreditation',
        'type',
        'affiliation',
        'mission',
        'vision',
        'logo',
        'established_date',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'accreditation' => 'array',
            'affiliation' =>  'array',
            'established_date' => 'date',
        ];
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
