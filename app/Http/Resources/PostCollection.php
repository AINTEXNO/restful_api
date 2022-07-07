<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'anons' => $this->anons,
            'text' => $this->text,
            'tags' => explode(',', $this->tags),
            'image' => public_path("storage\post_images\\{$this->image}"),
            'datetime' => $this->created_at->format('H:i d.m.Y'),
        ];
    }
}
