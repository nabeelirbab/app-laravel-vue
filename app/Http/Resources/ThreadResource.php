<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ThreadResource extends JsonResource
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
            'messages' => MessageResource::collection($this->messages->filter(
                    fn ($message) => $message->views
                    // ->filter(fn ($views) => ($views->view == 1 && $views->user_id == auth()->id())) 
                    ->filter(fn ($views) => ($views->user_id == auth()->id())) 
                    ->count() // if at least one found - timeline filter passed
                )),
            'users' => MessageReceiversResource::collection($this->users)
        ];
    }
}
