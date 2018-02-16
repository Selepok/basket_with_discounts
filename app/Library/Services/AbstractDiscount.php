<?php

namespace App\Library\Services;

abstract class AbstractDiscount implements DiscountInterface
{
    const DISCOUNT_TYPE_BOGO = 0;
    const DISCOUNT_TYPE_TOTAL = 1;
    const DISCOUNT_TYPE_LOYALTY_CARD_USER = 2;

    /**
     * value
     *
     * @var float
     */
    protected $value;

    /**
     * Set value
     *
     * @param float $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
