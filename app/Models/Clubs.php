<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sports ;
use App\Models\Standings ;
use App\Models\Matches ;
use App\Models\Videos;


class Clubs extends Model
{
    
    use HasFactory;
    
    public function sport()
    {
        return $this->belongsTo(Sports::class) ;
    }
    
    public function standing()
  {
    return $this->hasMany(Standings::class) ;
  }

  public function match()
  {
    return $this->hasMany(Matches::class) ;
  }
  /*public function information()
  {
    return $this->morphMany(Information::class,'information_able');
  }*/
  public function vidio()
  {
    return $this->morphMany(Videos::class,'video_able');
  }
 

}
