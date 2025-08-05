<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacunas extends Model
{
  protected $table = 'vacunas';

  protected $fillable = [
    'id_mascota',
    'id_veterinario',
    'vacuna',
    'fecha',
    'prox_fecha',
  ];

  public $timestamps = false;

  public function VETERINARIO()
  {
    return $this->belongsTo(User::class, 'id_veterinario');
  }
}
