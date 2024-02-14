<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;
    public function video_able()
    {
     return $this->morphTo();
    }

    protected $fillable=['uuid','url','description', 'video_able_type ','video_able_id '];


}
