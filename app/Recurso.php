<?php

namespace extravestibular;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $fillable = [
      'nome', 'cpf',
      'tipo', 'editalId',
      'motivo', 'nProcesso',
      'data', 'usuarioId',
      'homologado',
    ];
}
