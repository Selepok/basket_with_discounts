<?php

namespace App\Library\Services;

use App\BasketInterface;

interface DiscountInterface
{
    /**
     * Calculate discount
     *
     * @param BasketInterface $basket
     * @return float
     */
    public function calculateDiscount(BasketInterface $basket);
}