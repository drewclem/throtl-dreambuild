<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubmissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'collection_id' => $this->collection_id,
            'name' => $this->name,
            'email' => $this->email,
            'car' => $this->vehicle_year . ' ' . $this->vehicle_make . ' ' . $this->vehicle_model,
            'why' => $this->why,
            'throtl_username' => $this->throtl_username,
            'active_vip' => $this->active_vip,
            'is_winner' => $this->is_winner,
            'car_info' => $this->car_info,
            'dream_build' => $this->dream_build,
            'ig_post' => $this->ig_post,
            'fav_episode' => $this->fav_episode,
            'social_media' => $this->social_media,
            'terms_of_service' => $this->terms_of_service,
            'created_at' => Carbon::parse($this->created_at)->format('M d'),
        ];
    }
}
