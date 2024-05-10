<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'national_id',
        'full_name',
        'phone',
        'chronic_disease',
        'gentic_disease',
        'blood_type',
        'disease_senstivity	',
        'surgey',
        'medicine',
        'user_id'
    ];
    
    protected $hidden =[
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
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function user(){
        return $this->belongsTo(related:"App\Models\User" , foreignKey:"user_id");
    }
}
