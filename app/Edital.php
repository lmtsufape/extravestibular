<?php

namespace App;

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
        return $this->hasMany('App\Inscricao');
    }

    public function isencao()
    {
        return $this->hasMany('App\Isencao');
    }

    public function recurso()
    {
        return $this->hasMany('App\Recurso');
    }

    public function errata()
    {
        return $this->hasMany('App\Errata', 'editalId');
    }
}
