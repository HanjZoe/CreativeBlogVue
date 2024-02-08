<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Comments\CommetsResource;
use App\Http\Resources\Tag\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category_id' => $this->category_id,
            'content' => $this->content,
            'preview_image' => $this->preview_image,
            'created_at' => $this->created_at,
            'url_preview_image' => $this->url_preview_image,
            'main_image' => $this->main_image,
            'url_main_image' => $this->url_main_image,
            'category' => new CategoryResource($this->category),
            'tags' => TagResource::collection($this->tags),
            'comments' => CommetsResource::collection($this->comments),
        ];
    }
}
