<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'hospital_id',
        'floor',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function hospital(){
        return $this->belongsTo(related:"App\Models\Hospital" , foreignKey:"hospital_id");
    }
    public function reservation(){
        return $this->hasMany(related:"App\Models\Reservation" , foreignKey:"room_id");
    }
}
