<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isActive = $this->open_date <= now() && $this->close_date >= now();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'cta' => $this->cta,
            'subtitle' => $this->subtitle,
            'lowerBanner' => $this->lowerBanner,
            'total_submissions' => $this->submissions->count(),
            'open_date' => Carbon::parse($this->open_date)->format('M d'),
            'close_date' => Carbon::parse($this->close_date)->format('M d'),
            'image_url' => $this->image_url ?? 'https://i.pinimg.com/1200x/8e/47/aa/8e47aa3e621489a3f74a5edc34a1a7ab.jpg',
            'is_active' => $isActive,
            'slug' => $this->slug,
            'winner' => $this->winner,
            'winner_id' => $this->winner_id,
            'has_winner' => $this->winner_id !== null,
        ];
    }
}
