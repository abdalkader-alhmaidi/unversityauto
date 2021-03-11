<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Carbon\Carbon ;

class Users extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'title'=>  $this->collection,
          /*  'content'=> $this->content,
            'slice'=> $this->slice,
            'time'=>   $this->created_at->diffForHumans(),
             'to'=> $this->created_at->diffForHumans(),
        */
        ];
    }
}
