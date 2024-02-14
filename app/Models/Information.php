<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    public function information_able()
    {
        return $this->morphTo();
    }

    protected $fillable=[
       'uuid', 'title',	'image','content',	'reads',	'type', 	'information_able_type',	'information_able_id'

    ];
}
