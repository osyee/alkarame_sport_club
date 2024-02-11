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
    
    protected $fillable = [
      'uuid',
      'name' , 
      'when' , 
      'status' , 
      'plan' , 
      'channel' , 
      'round' , 
      'play_ground' , 
      'sessions_id' , 
      'club1_id' , 
      'club2_id' , 
     
];
protected $casts = [
  'uuid'=>'string',
  'name'=>'string' , 
  'when'=>'date' , 
  // 'status'=>'enum' ,
  'plan'=>'string', 
  'channel'=>'string', 
  'round'=>'int' , 
  'play_ground'=>'string' , 
  'sessions_id'=>'integer', 
  'club1_id'=>'integer' , 
  'club2_id'=>'integer' , 
];


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
