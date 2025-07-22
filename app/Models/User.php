<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles; // Only if you're using Spatie roles/permissions

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    use HasRoles; // Required for Spatie roles/permissions

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role', // optional if you're storing Spatie roles separately
    ];

    /**
     * Fields to hide from JSON responses
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Field casting
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * JWT: Get the identifier that will be stored in the subject claim of the JWT.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Usually the primary key (id)
    }

    /**
     * JWT: Return a key-value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
