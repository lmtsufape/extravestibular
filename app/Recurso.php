<?php

namespace extravestibular;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $fillable = [
      'tipo', 'editalId',
      'motivo',
      'data', 'usuarioId',
      'homologado',
      'motivoRejeicao',
    ];

    public function user()
    {
        return $this->belongsTo('extravestibular\User', 'usuarioId');
    }

    public function edital()
    {
        return $this->belongsTo('extravestibular\Edital', 'editalId');
    }
}
