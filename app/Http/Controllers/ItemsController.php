<?php

namespace App\Http\Controllers;

use App\BasketItem;
use App\Basket;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Store
     *
     * TODO validation
     * TODO Authorization
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $userId = 1;
        $basket = Basket::getUserBasketOrCreateIfNotExists($userId);

        $item = BasketItem::where('product_id', $request->get('product_id'))->first();

        if ($item instanceof BasketItem) {
            $item->quantity += $request->get('quantity');
        } else {
            $item = new BasketItem(
                array_merge(
                    $request->all(),
                    ['basket_id' => $basket->id]
                )
            );
        }

        $item->save();

        return response()->json($item, 201);
    }

    /**
     * Delete item
     *
     * @param BasketItem $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(BasketItem $item)
    {
        $item->delete();

        return response()->json([], 204);
    }

    /**
     * Clear
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clear()
    {
        $userId = 1;
        $basket = Basket::where('user_id', $userId)->first();

        if ($basket instanceof Basket) {
            $basket->clear();
        }

        return response()->json([], 204);
    }
}
