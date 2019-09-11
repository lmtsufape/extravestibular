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
