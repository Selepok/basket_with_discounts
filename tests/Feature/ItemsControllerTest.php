<?php

namespace Tests\Feature;

use App\Basket;
use Tests\ApiTest;

class ItemsControllerTest extends ApiTest
{
    /**
     * Set up
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Test item creation
     *
     * @return void
     */
    public function testCreateItem()
    {
        $data = $this->getItemData();

        $this->json('POST', 'api/v1/basket/items', $data)
            ->assertStatus(201)
            ->assertJson($data);
    }

    /**
     * Add product which is already exists
     * And check is quantity has been updated
     *
     * @return void
     */
    public function testAddItem()
    {
        $item = $this->createItem();

        $data = $this->getItemData();
        $data['product_id'] = $item->product_id;

        $this->json('POST', 'api/v1/basket/items', $data)
            ->assertStatus(201)
            ->assertJson([
                'quantity' => $item->quantity + $data['quantity']
            ]);
    }

    /**
     * Test delete item
     *
     * @return void
     */
    public function testDeleteItem()
    {
        $item = $this->createItem();

        $this->json('DELETE', 'api/v1/basket/items/' . $item->id)
            ->assertStatus(204);
    }

    /**
     * Test delete item which is not exists
     *
     * @return void
     */
    public function testDeleteItemWhichIsNotExists()
    {
        $this->json('DELETE', 'api/v1/basket/items/' . $this->faker->randomDigit)
            ->assertStatus(404);
    }

    /**
     * Test clear all items
     *
     * @return void
     */
    public function testClearItems()
    {
        // This action needed in order to create basket
        $this->createBasketWithItem();

        $this->createItems($this->faker->numberBetween(5,10));

        // Clear items
        $this->json('DELETE', 'api/v1/basket/items')
            ->assertStatus(204);

        /** @var Basket $basket */
        $basket = Basket::getBasket($this->user->id);
        $this->assertEquals(0, count($basket->getItems()));
    }
}
