<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clincal extends Model
{
    use HasFactory;
    protected $fillable = [
        'hospital_id',
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
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
        'created_at' => 'datetime',
    ];

    public function hospital(){
        return $this->belongsTo(related:"App\Models\Hospital" , foreignKey:"hospital_id");
    }
    
    public function reservation(){
        return $this->hasMany(related:"App\Models\Reservation" , foreignKey:"clincal_id");
    }

    public function doctor(){
        return $this->hasMany(related:"App\Models\Doctor" , foreignKey:"clincal_id");
    }
}
