<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        "id": 43,
//  "user_id": 14,
//  "status": "open",
//  "created_at": "2019-06-26 06:50:18",
//  "updated_at": "2019-06-26 06:50:18"
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'order_items' => OrderItemsResource::collection($this->orderItems),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
//        return parent::toArray($request);
    }
}
