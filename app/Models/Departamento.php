<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'id_departamento');
    }
}