<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sports ;
use App\Models\Topfans ;

class Associations extends Model
{
    use HasFactory;

    public function sport()
    {
        return $this->belongsTo(Sports::class) ;
    }

    public function topfan()
    {
      return $this->hasMany(Topfans::class) ;
     
    } 
}
