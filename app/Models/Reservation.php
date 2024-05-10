<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'user_id',
        'date',
        'time',
        'room_id',
        'hospital_id',
        'status',
        'name',
        'phone',
        'national_id',
        'clincal_id',
        'id'
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
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function user(){
        return $this->belongsTo(related:"App\Models\User" , foreignKey:"user_id");
    }

    public function doctor(){
        return $this->belongsTo(related:"App\Models\Doctor" , foreignKey:"doctor_id");
    }

    public function hospital(){
        return $this->belongsTo(related:"App\Models\Hospital" , foreignKey:"hospital_id");
    }

    public function clincal(){
        return $this->belongsTo(related:"App\Models\Clincal" , foreignKey:"clincal_id");
    }

    public function room(){
        return $this->belongsTo(related:"App\Models\Room" , foreignKey:"room_id");
    }
}
