<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Séance extends Model
{
    public function qrcode()
    {
        return $this->hasOne('App\Qrcode');
    }
}
