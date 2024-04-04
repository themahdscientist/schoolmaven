<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lga extends Model
{
    use HasFactory;

    protected $fillable = ['state_id', 'name', 'capital'];

    public function school(): HasMany
    {
        return $this->hasMany(School::class);
    }
}
