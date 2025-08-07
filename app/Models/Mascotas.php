<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Mascotas extends Model
{
  protected $table = 'mascotas';

  protected $fillable = [
    'codigo', 
    'id_cliente',
    'nombre',
    'edad',
    'peso',
    'foto',
    'especie',
    'raza',
    'sexo',
    'detalles'
  ];



  public $timestamps = false;

  public function DUEÑO()
  {
    return $this->belongsTo(Clientes::class, 'id_cliente');
  }
}
