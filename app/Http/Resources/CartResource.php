<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Rupiah;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'product_id' => $this->product_id,
            'count' => $this->count,
            'price' => $this->price,
            'price_rupiah' => Rupiah::get_rupiah($this->price),
            'product_name' => $this->product->name,
            'category' => $this->product->category->category,
            'image' => env('ASSET_URL')."/uploads/product/".$this->product->image,
        ];
    }
}
