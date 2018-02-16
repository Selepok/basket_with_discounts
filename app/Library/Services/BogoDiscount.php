<?php

namespace App\Library\Services;

use App\BasketInterface;

class BogoDiscount extends AbstractDiscount
{
    /**
     * Discount ratio
     * For example we want to give 40% discount
     * we should set it to 0.4
     * If we want to give second item for free
     * we should set it to 1.0
     *
     * @var int
     */
    protected $value;

    /**
     * @var array
     */
    protected $discountProductsList;

    /**
     * BogoDiscount constructor.
     *
     * @param array $discountProductsList
     */
    public function __construct(array $discountProductsList)
    {
        $this->discountProductsList = $discountProductsList;
    }

    /**
     * Calculate discount
     *
     * @param BasketInterface $basket
     * @return float
     */
    public function calculateDiscount(BasketInterface $basket)
    {
        $discountValue = 0;

        foreach ($basket->getItems() as $item) {
            if (in_array($item->product_id, $this->discountProductsList) && $item->quantity > 1) {
                $discountValue += floor($item->quantity / 2) * $item->price * $this->value;
            }
        }

        return $discountValue;
    }
}
