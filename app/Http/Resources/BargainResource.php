<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BargainResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user->name,
            'product_id' => $this->product->name,
            'price' => $this->price,
            'price_offer' => $this->price_offer,
            'total_item' => $this->total_item,
            'status' => $this->status
        ];
    }
}
