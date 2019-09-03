<?php

namespace extravestibular;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuarioId',
        'tipo',
        'editalId',
        'declaracaoDeVinculo',
        'historicoEscolar',
        'programaDasDisciplinas', '
        curriculo',
        'enem',
        'comprovante',
        'curso',
        'polo',
        'turno',
		    'cursoDeOrigem',
        'instituicaoDeOrigem',
		    'naturezaDaIes',
        'enderecoIes',
        'homologado',
        'motivoRejeicao',
        'homologadoDrca',
        'coeficienteDeRendimento',
        'conclusaoDoCurso',
        'nota',
        'cpfCandidato'
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
