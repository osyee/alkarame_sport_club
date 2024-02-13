<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sports ;
use App\Models\Topfans ;

class Associations extends Model
{
    use HasFactory;

    protected $fillable = [
      'uuid',
      'boss',
      'image',
      'country',
      'description',
      'Sports_id'
    ] ;

    protected $casts = 
    [
      'uuid'=> 'string',
      'boss'=>'string',
      'image'=>'string',
      'country'=>'string',
      'description'=>'string',
    ] ;

    public function sport()
    {
        return $this->belongsTo(Sports::class,'Sports_id') ;
    }

    public function topfan()
    {
      return $this->hasMany(Topfans::class) ;
     
    } 
}
