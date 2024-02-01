<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Associations ;

class Topfans extends Model
{
    use HasFactory;
protected $table = 'topfans';

protected $fillable = [
    'associations_id'
] ;
 protected $casts = [] ;
 protected $hidden = [] ;

    public function association()
    {
        return $this->belongsTo(Associations::class) ;
    }

    
}
