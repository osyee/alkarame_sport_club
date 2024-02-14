<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class resourcewears extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[

            'image'=>$this->image,
            'Sports_id  '=>$this->sport->name ,
            'sessions_id '=>$this->session->name  ,

        ];
    }
}
