<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sports ;

class Employees extends Model
{
    use HasFactory;
    protected $table = 'employees';

protected $fillable = [
    'uuid',
    'name',
    'job_type',
    'work',
    'image',
    'Sports_id',
    
] ;
 
    public function sport()
    {
        return $this->belongsTo(Sports::class,'Sports_id') ;
    }
    
}
