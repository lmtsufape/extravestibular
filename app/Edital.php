<?php

namespace extravestibular;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Edital extends Model
{
    //

    use SoftDeletes;

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
      'resultado',
      'inicioRecursoResultado',
      'fimRecursoResultado',
      'resultadoFinal',
      'publicado',
      'dataPublicacao',
      'descricao',
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

    public function errata()
    {
        return $this->hasMany('extravestibular\Errata', 'editalId');
    }
}
