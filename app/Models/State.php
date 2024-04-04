<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'name', 'iso2', 'capital'];

    public function school(): HasMany
    {
        return $this->hasMany(School::class);
    }
}
