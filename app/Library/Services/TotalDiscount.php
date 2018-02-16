<?php

namespace App\Library\Services;

use App\BasketInterface;

class TotalDiscount extends AbstractDiscount
{
    /**
     * Calculate discount
     *
     * @param BasketInterface $basket
     * @return float
     */
    public function calculateDiscount(BasketInterface $basket)
    {
        return $basket->getTotal() * (1 - $this->value);
    }
}
