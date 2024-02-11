<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Plans ;
use App\Models\Sports ;
use App\Models\Replacements ;

class Players extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name' , 
        'high' ,
        'play' ,
        'number' ,
        'born' , 
        'from',
        'first_club' ,
        'career' ,
        'image' ,
        'Sports_id'
  ];
  protected $casts = [
    'uuid'=>'string',
    'name'=>'string',
    'play'=>'string',
    'high'=>'integer',
    'number'=>'integer',
    'born'=>'date',
    'from'=>'string',
    'from'=>'string',
    'first_club'=>'string',
    'career'=>'string',
    'image'=>'string',
    'Sports_id'=>'integer',
  ];

    public function plan()
    {
      return $this->hasMany(Plans::class) ;
    } 

    public function sport()
    {
        return $this->belongsTo(Sports::class) ;
    }

    public function replacment()
    {
      return $this->hasMany(Replacements::class) ;
    } 
}
