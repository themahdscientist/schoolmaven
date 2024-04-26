<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPassword //, MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'school_id',
        'username',
        'email',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'dob',
        'phone',
        'address',
        'lga_id',
        'state_id',
        'country_id',
        'lga_origin_id',
        'state_origin_id',
        'nationality_id',
        'postal_code',
        'avatar',
        'status',
        'religion',
        'email_verified_at',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'dob' => 'date',
        ];
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->first_name.($this->middle_name ? ' '.$this->middle_name : '').' '.$this->last_name,
        );
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function administrator(): HasOne
    {
        return $this->hasOne(Administrator::class);
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    public function students(): HasManyThrough
    {
        return $this->through('guardian')->has('students');
    }

    public function guardian(): HasOne
    {
        return $this->hasOne(Guardian::class);
    }

    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function lga(): BelongsTo
    {
        return $this->belongsTo(Lga::class);
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    public function stateOrigin(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_origin_id');
    }

    public function lgaOrigin(): BelongsTo
    {
        return $this->belongsTo(Lga::class, 'lga_origin_id');
    }
}
