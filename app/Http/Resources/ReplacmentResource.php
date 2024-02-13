<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReplacmentResource extends ResourceCollection
{
    public function toArray($request)
    {
        return [
           
          
            'inplayer_id'=>$this->inplayer_id,
            'outplayer_id'=>$this->outplayer_id,
            'matches_id'=>$this->matches_id,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
