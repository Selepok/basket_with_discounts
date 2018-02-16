<?php

namespace App\Library\Services;

use Illuminate\Database\Eloquent\Model;

interface DiscountFactoryInterface
{
    /**
     * Get discount
     *
     * @param Model $discountRecord
     * @return AbstractDiscount
     */
    public function getDiscount(Model $discountRecord);
}
