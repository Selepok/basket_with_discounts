<?php
/**
 * Created by PhpStorm.
 * User: vdor
 * Date: 12.02.18
 * Time: 18:29
 */

namespace App\Library\Services;

use App\BasketInterface;
use App\Discount;

class DiscountHandler implements DiscountInterface
{
    /**
     * Discounts
     *
     * @var array
     */
    protected $discounts;

    /**
     * DiscountFactory
     *
     * @var DiscountFactoryInterface
     */
    protected $discountFactory;

    public function __construct(DiscountFactoryInterface $discountFactory)
    {
        $this->discountFactory = $discountFactory;

        $this->initDiscounts();
    }

    /**
     * Init discounts
     */
    protected function initDiscounts()
    {
        $activeDiscounts = Discount::getActiveDiscounts();

        /** @var Discount $item */
        foreach ($activeDiscounts as $item) {
            $this->discounts[]  = $this->discountFactory->getDiscount($item);
        }
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
        if (!empty($this->discounts)) {
            /** @var AbstractDiscount $discount */
            foreach ($this->discounts as $discount) {
                $discountValue += $discount->calculateDiscount($basket);
            }
        }

        return $discountValue;
    }
}
