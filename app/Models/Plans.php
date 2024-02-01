<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Players ;
use App\Models\Matches ;

class Plans extends Model
{
    use HasFactory;

    public function player()
    {
        return $this->belongsTo(Players::class) ;
    }

    public function match()
    {
        return $this->belongsTo(Matches::class) ;
    }

}
