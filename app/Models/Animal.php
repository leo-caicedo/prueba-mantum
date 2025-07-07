<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birthdate'
    ];

    public function typeAnimal()
    {
        return $this->belongsTo(TypeAnimal::class);
    }
}
