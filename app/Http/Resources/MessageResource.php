<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'sender' => $this->sender->id,
            'date' => $this->created_at,
            'type' => $this->type,
            'views' => $this->views->filter(function ($view) {
                return $view->user_id == auth()->id();
            })->values()
        ];
    }
}
