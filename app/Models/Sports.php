<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clubs ;
use App\Models\Associations ;
use App\Models\Employees;
use App\Models\Primes;
use App\Models\Players;
use App\Models\Wears;

class Sports extends Model
{
    use HasFactory;
     
  public function association()
  {
    return $this->hasMany(Associations::class) ;
  }

  public function club()
  {
    return $this->hasMany(Clubs::class) ;
  } 

  public function employee()
  {
    return $this->hasMany(Employees::class) ;
  } 

  public function prime()
  {
    return $this->hasMany(Primes::class) ;
  } 

  public function player()
  {
    return $this->hasMany(Players::class) ;
  } 

  public function wear()
  {
    return $this->hasMany(Wears::class) ;
  } 

  


  
}
