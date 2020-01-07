<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medidor extends Model
{
  protected $table = 'medidores';

  protected $fillable = [
      'cuenta', 'numero_medidor', 'uso', 'tarifa', 'lectura'
  ];

  public function periodos()
  {
    return $this->hasMany('App\Periodo', 'medidor_id')->orderBy('created_at', 'desc');
  }
}
