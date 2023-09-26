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
            'open_date' => $this->open_date,
            'close_date' => $this->close_date,
            'open_date_formatted' => Carbon::parse($this->open_date)->format('M d'),
            'close_date_formatted' => Carbon::parse($this->close_date)->format('M d'),
            'image_url' => $this->image_url,
            'is_active' => $isActive,
            'slug' => $this->slug,
            'winner' => $this->winner,
            'winner_id' => $this->winner_id,
            'has_winner' => $this->winner_id !== null,
            'color' => $this->color ?? '#ff4310',
        ];
    }
}
