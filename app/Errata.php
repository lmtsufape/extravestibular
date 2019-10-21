<?php

namespace extravestibular;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Errata extends Model
{
    use SoftDeletes;

    protected $fillable = ['descricao', 'nome', 'editalId'];

    public function edital(){
      return $this->belongsTo('extravestibular\Edital', 'editalId');
    }
}
