<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'value',
        'order',
        'isActive'
    ];

    public static function getActiveDiscounts()
    {
        return Discount::all()
            ->where('isActive', 1)
            ->sortBy('order');
    }

    public function getDiscountProducts()
    {
        $products = [];
        $collection = $this->hasMany(DiscountProducts::class)->get(['product_id']);

        foreach ($collection as $item) {
            $products[] = $item->product_id;
        }

        return $products;
    }
}
