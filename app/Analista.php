<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analista extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function edital()
    {
        return $this->belongsTo('App\Edital');
    }
}
