<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CovidForm extends Model
{
    use HasFactory, SoftDeletes;

    
    protected $fillable = [
        'symptoms',
        'patient_id',
        'user_id',
        'result'
    ];
    
    protected $casts = [
        'symptoms' => 'array'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function patient() {

        return $this->belongsTo(Patient::class);
    }

    public function user() {

        return $this->belongsTo(User::class);
    }

}
