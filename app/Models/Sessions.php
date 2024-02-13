<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Primes ;
use App\Models\Wears ;
use App\Models\Matches ;
use App\Models\Standings ;
use App\Models\Information;

class Sessions extends Model
{
    use HasFactory;


    public function prime()
    {
        return $this->hasMany(Primes::class) ;
    }

    public function wear()
    {
        return $this->hasMany(Wears::class) ;
    }

    public function match()
  {
    return $this->hasMany(Matches::class) ;
  }

  public function standing()
  {
    return $this->hasMany(Standings::class) ;
  }

 /* public function information()
  {
    return $this->morphMany(Information::class,'information_able');
  }*/


}
