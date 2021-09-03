<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => ArticleResource::Collection($this->collection),
            'meta' => [
                'count' => $this->total(),
                'limit' => $this->perPage(),
                'pages' => $this->lastPage(),
                'page' => $this->currentPage()
            ]
        ];
    }
}
