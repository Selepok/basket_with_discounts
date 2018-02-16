<?php

namespace Tests;

use App\Basket;
use App\BasketItem;
use App\Discount;
use App\Library\Services\AbstractDiscount;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
Use App\User;

class ApiTest extends TestCase
{
    use DatabaseMigrations;

    /** @var  User */
    protected $user;

    /**
     * @var Generator
     */
    protected $faker;

    /**
     * Set up
     */
    public function setUp()
    {
        parent::setUp();

        $this->user = $this->createUser();
        $this->faker = Factory::create();
    }

    /**
     * Create user
     *
     * @param int $hasLoyaltyCard
     * @return User
     */
    protected function createUser($hasLoyaltyCard = 1)
    {
        $attributes = [
            'has_loyalty_card' => $hasLoyaltyCard
        ];

        return factory(User::class)->create($attributes);
    }

    /**
     * Create item
     *
     * @param array $attributes
     * @return BasketItem
     */
    protected function createItem($attributes = [])
    {
        return factory(BasketItem::class)->create($attributes);
    }

    /**
     * Create items
     *
     * @param int $count
     */
    protected function createItems($count)
    {
        for ($i = 0; $i < $count; $i++) {
            $this->createItem();
        }
    }

    protected function createDiscounts()
    {
        // TODO move it to fixtures or something like that
        $discounts = [
            [
                'type' => AbstractDiscount::DISCOUNT_TYPE_BOGO,
                'value' => 1,
                'order' => 0,
                'isActive' => 1
            ],
            [
                'type' => AbstractDiscount::DISCOUNT_TYPE_TOTAL,
                'value' => 0.1,
                'order' => 1,
                'isActive' => 1
            ],
            [
                'type' => AbstractDiscount::DISCOUNT_TYPE_LOYALTY_CARD_USER,
                'value' => 0.02,
                'order' => 2,
                'isActive' => 1
            ]
        ];

        foreach ($discounts as $discount) {
            Discount::create($discount);
        }
    }

    protected function createBasketWithItem()
    {
        $this->json('POST', 'api/v1/basket/items', $this->getItemData());
    }

    /**
     * Get item data
     *
     * @return array
     */
    protected function getItemData()
    {
        return
            [
                'product_id' => $this->faker->numberBetween(1,100),
                'quantity' => $this->faker->numberBetween(1,10),
                'price' => $this->faker->numberBetween(1,1000),
            ];
    }

    /**
     * Create basket
     *
     * @return Basket
     */
    protected function createBasket()
    {
        return Basket::create([
            'user_id' => $this->user->id
        ]);
    }
}
