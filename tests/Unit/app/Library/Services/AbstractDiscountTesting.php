<?php

namespace Tests\Unit\app\Library\Services;

use App\Basket;
use App\BasketItem;
use App\User;
use Tests\TestCase;
use \Mockery;
use Illuminate\Database\Eloquent\Collection;

class AbstractDiscountTesting extends TestCase
{
    /**
     * Items data
     *
     * TODO move it to fixtures or something like that
     *
     * @var array
     */
    protected $itemsData = [
        [
            'product_id' => 1,
            'quantity' => 7,
            'price' => 10,
        ],
        [
            'product_id' => 2,
            'quantity' => 6,
            'price' => 20,
        ],
        [
            'product_id' => 3,
            'quantity' => 6,
            'price' => 35,
        ]
    ];

    /**
     * Get items collection
     *
     * @param array $itemsData
     * @return Collection
     */
    protected function getItemsCollection(array $itemsData)
    {
        $items = new Collection();

        foreach ($itemsData as $data) {
            $item = factory(BasketItem::class)->make($data);
            $items->add($item);
        }

        return $items;
    }

    /**
     *Get basket mock
     *
     * @param array $itemsData
     * @param int $total
     * @return Mockery\MockInterface
     */
    protected function getBasketMock(array $itemsData, $total = 100)
    {
        $basketMock = Mockery::mock(Basket::class);
        $basketMock->shouldReceive('getItems')->andReturn($this->getItemsCollection($itemsData));
        $basketMock->shouldReceive('getTotal')->andReturn($total);

        return $basketMock;
    }

    /**
     * Get user
     *
     * @return User
     */
    protected function getUser()
    {
        return factory(User::class)->make();
    }

    /**
     * Tear down
     */
    public function tearDown()
    {
        Mockery::close();
    }
}
