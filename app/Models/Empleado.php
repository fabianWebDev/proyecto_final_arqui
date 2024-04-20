<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'fecha_ingreso',
        'cedula',
        'correo_electronico',
        'id_departamento',
        'id_perfil',
        'id_puesto',
        'id_horario',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'id_puesto');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_empleado');
    }

    public function asistencia()
    {
        return $this->hasMany(User::class, 'id_empleado');
    }

}
