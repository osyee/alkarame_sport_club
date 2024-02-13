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
