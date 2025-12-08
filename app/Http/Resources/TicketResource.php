<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class TicketResource extends JsonResource
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
            'subject' => $this->subject,
            'text' => $this->text,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'manager_id' => new UserResource($this->whenLoaded('manager')),
            'customer_id' => new CustomerResource($this->whenLoaded('customer')),
            // 'files'=> MediaResource::collection($this->getMedia('attachments')),
        ];
    }
}
