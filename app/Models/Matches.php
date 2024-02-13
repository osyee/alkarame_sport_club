<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 use App\Models\Plans ;
 use App\Models\Replacements;
 use App\Models\Clubs;
 use App\Models\Sessions;
 use App\Models\Statistics ;

class Matches extends Model
{
    use HasFactory;
    

  public function plan()
  {
    return $this->hasMany(Plans::class) ;
  } 

  public function replacment()
  {
    return $this->hasMany(Replacements::class) ;
  } 

  public function session()
  {
      return $this->belongsTo(Sessions::class) ;
  }

  public function club1()
  {
      return $this->belongsTo(Clubs::class,'club1_id') ;
  }

  public function club2()
  {
      return $this->belongsTo(Clubs::class,'club2_id') ;
  }

  public function statistic()
  {
    return $this->hasMany(Statistics::class) ;
  } 
}
