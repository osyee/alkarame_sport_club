<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Players ;
use App\Models\Matches ;

class Replacments extends Model
{
    use HasFactory;
    protected $table="replacments";
    protected $fillable=[
        'uuid',
        'inplayer_id',
        'outplayer_id',
        'matches_id',
    ];
    public function outplayer()
    {
        return $this->belongsTo(Players::class,'outplayer_id') ;
    }

    public function inplayer()
    {
        return $this->belongsTo(Players::class,'inplayer_id') ;
    }


    public function match()
    {
        return $this->belongsTo(Matches::class) ;
    }
}
