<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergency_case extends Model
{
    use HasFactory;
    protected $fillable = [
        'hospital_id',
        'user_id',
        
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
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user(){
        return $this->belongsTo(related:"App\Models\User" , foreignKey:"user_id");
    }

    public function hospital(){
        return $this->belongsTo(related:"App\Models\Hospital" , foreignKey:"hospital_id");
    }
}
