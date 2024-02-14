<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class resourcesinfo extends JsonResource
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
            'title'=>$this->title,
            'content'=>$this->content,
            'image'=>$this->image,
            'reads'=>$this->reads,
            'type'=>$this->type,
            'created_at'=>Carbon::parse($this->created_at)->diffForHumans(),
            'name'=>$this->whenLoaded('information_able',function(){return $this->information_able->name;}),
            

        ];
    }
}
