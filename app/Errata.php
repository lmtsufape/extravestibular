<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Errata extends Model
{
    use SoftDeletes;

    protected $fillable = ['arquivo', 'nome', 'editalId'];

    public function edital(){
      return $this->belongsTo('App\Edital', 'editalId');
    }
}
