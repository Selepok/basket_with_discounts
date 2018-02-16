<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model implements BasketInterface
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItems()
    {
        return $this->hasMany(BasketItem::class)->get();
    }

    public function clear()
    {
        return $this->hasMany(BasketItem::class)->delete();
    }

    public static function getBasket($userId)
    {
        return Basket::where('user_id', $userId)->first();
    }

    public static function getUserBasketOrCreateIfNotExists($userId)
    {
        $basket = self::getBasket($userId);

        if (is_null($basket)) {
            $basket = new Basket(['user_id' => $userId]);
            $basket->save();
        }

        return $basket;
    }

    public function calculateTotal()
    {
        $total = 0;

        $items = $this->getItems();

        foreach ($items as $item) {
            $total += $item->quantity * $item->price;
        }

        $this->setTotal($total);
    }
}
