<?php

namespace extravestibular;

use Illuminate\Database\Eloquent\Model;

class Edital extends Model
{
    //
    protected $fillable = ['vagas', 'inicioInscricoes', 'fimInscricoes', 'pdfEdital'];

}
