<?php

namespace Tests\Unit\app\Library\Services;

use App\Library\Services\BogoDiscount;

class BogoDiscountTest extends AbstractDiscountTesting
{
    /**
     * Test calculate bogo discount
     *
     * @return void
     */
    public function testCalculateBogoDiscount()
    {
        $basketMock = $this->getBasketMock($this->itemsData);

        $bogoDiscount = new BogoDiscount([1,2]);
        $bogoDiscount->setValue(1);
        $this->assertEquals(90, $bogoDiscount->calculateDiscount($basketMock));
    }
}
