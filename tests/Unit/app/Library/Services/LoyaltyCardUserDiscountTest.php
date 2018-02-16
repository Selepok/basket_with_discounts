<?php

namespace Tests\Unit\app\Library\Services;

use App\Library\Services\LoyaltyCardUserDiscount;

class LoyaltyCardUserDiscountTest extends AbstractDiscountTesting
{
    /**
     * Test loyalty card user discount
     *
     * @return void
     */
    public function testCalculateLoyaltyCardUserDiscount()
    {
        $basketMock = $this->getBasketMock($this->itemsData);

        $user = $this->getUser();

        $loyaltyCardDiscount = new LoyaltyCardUserDiscount($user);
        $loyaltyCardDiscount->setValue(0.02);
        $this->assertEquals(98, $loyaltyCardDiscount->calculateDiscount($basketMock));
    }
}
