<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Hospital extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'password',
        'rooms',
        'intensive_care',
        'quarantine_rooms',
        'emergency_days',
        'clincals',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

     // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function doctor(){
        return $this->hasMany(related:"App\Models\Doctor" , foreignKey:"hospital_id");
    }
    public function room(){
        return $this->hasMany(related:"App\Models\Room" , foreignKey:"hospital_id");
    }

    public function clincal(){
        return $this->hasMany(related:"App\Models\Clincal" , foreignKey:"hospital_id");
    }

    public function reservation(){
        return $this->hasMany(related:"App\Models\Reservation" , foreignKey:"hospital_id");
    }

    public function EmergencyCase(){
        return $this->hasMany(related:"App\Models\Emergency_case" , foreignKey:"hospital_id");
    }
}
