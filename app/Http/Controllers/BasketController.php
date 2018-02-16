<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Library\Services\DiscountFactory;
use App\Library\Services\DiscountHandler;
use App\User;

class BasketController extends Controller
{
    /**
     * Update
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $user = $this->getUser();

        /** @var Basket $basket */
        $basket = Basket::getBasket($user->id);

        if ($basket) {
            $basket->calculateTotal();

            if (count($basket->getItems())) {
                /**
                 * TODO It would be better to make DiscountHandler
                 * TODO as service inject there DiscountFactory
                 * TODO and move it to ServiceProvider
                 */
                $factory = new DiscountFactory($user);
                $discountHandler = new DiscountHandler($factory);
                $basket->setTotal($basket->getTotal() - $discountHandler->calculateDiscount($basket));

                $basket->save();
            }

            return response()->json($basket, 200);
        }

        return response()->json(
            ["error_message" => "The basket for current user doesn't exists."],
            404
        );
    }

    /**
     * TODO Authorization
     *
     * @return mixed
     */
    protected function getUser()
    {
        return User::find(1);
    }
}
