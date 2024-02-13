<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sports ;
use App\Models\Sessions ;

class Primes extends Model
{
    use HasFactory;
    protected $table ="Primes";

    protected $fillable=[
        'uuid',
        'name',
        'descreption',
        'Sports_id',
        'sessions_id',
        'image',
        'type',
      

    ];
    public function sport()
    {
        return $this->belongsTo(Sports::class,'Sports_id') ;
    }

    public function session()
    {
        return $this->belongsTo(Sessions::class,'sessions_id') ;
    }


}
