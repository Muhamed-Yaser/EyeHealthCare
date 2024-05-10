<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'image',
        'medicine',
        'problem',
        'user_id'
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

    public function user(){
        return $this->belongsTo(related:"App\Models\User" , foreignKey:"user_id");
    }
    public function doctor(){
        return $this->belongsTo(related:"App\Models\Doctor" , foreignKey:"doctor_id");
    }
}
