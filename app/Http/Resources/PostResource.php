<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
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
            'comments' => CommentResource::collection($this->comments),
        ];
    }
}
