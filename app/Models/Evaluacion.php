<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pregunta',
        'puntuacion',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id_evaluacion');
    }
}
