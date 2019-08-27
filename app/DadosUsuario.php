<?php

namespace extravestibular;

use Illuminate\Database\Eloquent\Model;

class DadosUsuario extends Model
{
    protected $fillable = [
      'nome',
      'rg',
      'orgaoEmissor',
      'orgaoEmissorUF',
      'cpf',
      'tituloEleitoral',
      'filiacao',
      'endereco',
      'num',
      'bairro',
      'cidade',
      'uf',
      'foneResidencial',
      'foneCelular',
      'foneComercial',
    ];
    public function user()
    {
        return $this->hasOne('extravestibular\User');
    }
}
