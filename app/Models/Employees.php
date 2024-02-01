<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sports ;

class Employees extends Model
{
    use HasFactory;
    public function sport()
    {
        return $this->belongsTo(Sports::class) ;
    }
    
}
