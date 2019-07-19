<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // id": 25,
        //             "order_id": 35,
        //             "product_id": 15,
        //             "qty": 6,
        //             "status": "Approved",
        //             "comment": "test",
        //             "created_at": "2019-06-23 11:48:04",
        //             "updated_at": "2019-06-26 06:58:53"
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'qty' => $this->qty,
            'status' => $this->status,
            'comment' => $this->comment,
            'product' => new ProductResource($this->product),
            // 'order_items' => OrderItemsResource::collection($this->orderItems),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        return parent::toArray($request);
    }
}
