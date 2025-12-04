<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdutoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            ...parent::toArray($request),
            'media'=>$this->whenLoaded('media',function(){
                // return $this->media->map(fn($m)=>$m->source);
                return  $this->media->map(function($media){
                   if(Str::contains($media->source, 'http'))
                        return $media->source;
                    else return asset(Storage::url('produtos/'.$media->source));
                });
            }),
        ];
    }
}
