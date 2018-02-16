<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'basket_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function getBasketItems($basketId)
    {
        return BasketItem::all()->where('basketId', $basketId)->toArray();
    }
}
