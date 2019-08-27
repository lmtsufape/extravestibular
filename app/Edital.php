<?php

namespace extravestibular;

use Illuminate\Database\Eloquent\Model;

class Edital extends Model
{
    //
    protected $fillable = [
      'vagas',
      'inicioInscricoes',
      'fimInscricoes',
      'pdfEdital',
      'nome',
      'inicioRecurso',
      'fimRecurso',
      'inicioIsencao',
      'fimIsencao',
      'inicioRecursoIsencao',
      'fimRecursoIsencao',
    ];

    public function inscricao()
    {
        return $this->hasMany('extravestibular\Inscricao');
    }

    public function isencao()
    {
        return $this->hasMany('extravestibular\Isencao');
    }

    public function recurso()
    {
        return $this->hasMany('extravestibular\Recurso');
    }
}
