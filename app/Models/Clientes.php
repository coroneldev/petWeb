<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
  protected $table = 'clientes';

  protected $fillable = [
    'nombre',
    'documento',
    'telefono',
    'email',
    'direccion',
  ];

  public $timestamps = false;
}
