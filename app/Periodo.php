<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
  protected $table = 'periodos';

  protected $fillable = [
      'lectura', 'medidor_id'
  ];

  public function medidor()
  {
    return $this->belongsTo('App\Medidor');
  }
}
