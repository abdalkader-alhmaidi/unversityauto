<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Resources\Json\JsonResource;

class Advertisment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title'=>  $this->title,
             'content'=> $this->content,
             'slice'=> explode(',',$this->slice),
             'time'=>   $this->created_at->diffForHumans(),
              'to'=> $this->period->diffForHumans(),
         
         ];
    }
}
