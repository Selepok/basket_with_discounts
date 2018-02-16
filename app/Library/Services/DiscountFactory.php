<?php
/**
 * Created by PhpStorm.
 * User: vdor
 * Date: 12.02.18
 * Time: 18:16
 */

namespace App\Library\Services;

use App\Discount;
use Illuminate\Database\Eloquent\Model;

class DiscountFactory implements DiscountFactoryInterface
{
    /**
     * User
     *
     * @var Model
     */
    protected $user;

    /**
     * DiscountFactory constructor.
     *
     * @param Model $user
     */
    public function __construct(Model $user)
    {
        $this->user = $user;
    }

    /**
     * Get discount
     *
     * @param Model $discountRecord
     * @return AbstractDiscount
     */
    public function getDiscount(Model $discountRecord)
    {
        switch ($discountRecord->type) {
            case AbstractDiscount::DISCOUNT_TYPE_BOGO:
                /** @var Discount $discountRecord */
                $discount = new BogoDiscount($discountRecord->getDiscountProducts());
                break;
            case AbstractDiscount::DISCOUNT_TYPE_TOTAL:
                $discount = new TotalDiscount();
                break;
            case AbstractDiscount::DISCOUNT_TYPE_LOYALTY_CARD_USER:
                $discount = new LoyaltyCardUserDiscount($this->user);
                break;
            default:
                // TODO throw some exception
        }

        $discount->setValue($discountRecord->value);

        return $discount;
    }
}
