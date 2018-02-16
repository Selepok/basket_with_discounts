<?php

namespace Tests\Unit\app\Library\Services;

use App\Library\Services\TotalDiscount;

class TotalDiscountTest extends AbstractDiscountTesting
{
    /**
     * Test calculate total discount
     *
     * @return void
     */
    public function testCalculateTotalDiscount()
    {
        $basketMock = $this->getBasketMock($this->itemsData);

        $totalDiscount = new TotalDiscount();
        $totalDiscount->setValue(0.1);
        $this->assertEquals(90, $totalDiscount->calculateDiscount($basketMock));
    }
}
