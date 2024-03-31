<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'administrator_code',
        'position',
        'nationality',
        'state_origin',
        'lga_origin',
    ];
}