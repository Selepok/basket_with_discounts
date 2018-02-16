<?php

namespace App\Library\Services;

use App\BasketInterface;
use App\User;
use Illuminate\Database\Eloquent\Model;

class LoyaltyCardUserDiscount extends AbstractDiscount
{
    /**
     * User
     *
     * @var User
     */
    protected $user;

    /**
     * LoyaltyCardUserDiscount constructor.
     *
     * @param Model $user
     */
    public function __construct(Model $user)
    {
        $this->user = $user;
    }

    /**
     * Calculate discount
     *
     * @param BasketInterface $basket
     * @return float
     */
    public function calculateDiscount(BasketInterface $basket)
    {
        return $this->user->hasLoyaltyCard()
            // Here we could also to use TotalDiscount class.
            // For example inject it in constructor,
            // set value = 2% and invoke applyDiscount
            ? $basket->getTotal() * (1 - $this->value)
            : 0;
    }
}
