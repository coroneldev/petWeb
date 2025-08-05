<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Mascotas extends Model
{
  protected $table = 'mascotas';

  protected $fillable = [
    'nombre',
    'id_cliente',
    'edad',
    'peso',
    'foto',
    'detalles',
    'especie',
    'raza',
    'sexo',
  ];

  public $timestamps = false;

  public function DUEÑO()
  {
    return $this->belongsTo(Clientes::class, 'id_cliente');
  }
}
