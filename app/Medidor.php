<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medidor extends Model
{
  protected $table = 'medidores';

  protected $fillable = [
      'cuenta', 'numero_medidor', 'uso', 'tarifa'
  ];
}
