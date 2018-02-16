<?php

namespace Tests\Feature;

use Tests\ApiTest;

class BasketControllerTest extends ApiTest
{
    public function setUp()
    {
        parent::setUp();

        $this->createDiscounts();
    }

    /**
     * Test update basket with items
     *
     * @return void
     */
    public function testUpdateBasket()
    {
        $this->createBasketWithItem();
        $this->createItems(4);

        $this->json('PUT', 'api/v1/basket')
            ->assertStatus(200)
            ->assertJsonStructure([
                'user_id',
                'total'
            ]);
    }

    /**
     * Test update basket without items
     *
     * @return void
     */
    public function testUpdateBasketWithoutItems()
    {
        $basket = $this->createBasket();

        $this->json('PUT', 'api/v1/basket')
            ->assertStatus(200)
            ->assertJson([
                'updated_at' => $basket->updated_at
            ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateWithNobasket()
    {
        $this->createItems(4);

        $this->json('PUT', 'api/v1/basket')
            ->assertStatus(404)
            ->assertJson([
                "error_message" => "The basket for current user doesn't exists."
            ]);
    }
}
