<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'salario'
    ];

    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'id_puesto');
    }
}
