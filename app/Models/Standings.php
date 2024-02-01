<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clubs ;
use App\Models\Sessions;

class Standings extends Model
{
    use HasFactory;

    public function club()
    {
        return $this->belongsTo(Clubs::class) ;
    }

    public function session()
    {
        return $this->belongsTo(Sessions::class) ;
    }


}
