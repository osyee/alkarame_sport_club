<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrimesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
        'uuid'=>$this->uuid,
        'name'=>$this->name,
        'descreption'=>$this->descreption,
        'Sports_id'=>$this->sport->name,
        'sessions_id'=>$this->session->name,
        'descreption' =>$this->descreption,
        'image'=>$this->image,
        'type'=>$this->type,
        ];
    }
}
