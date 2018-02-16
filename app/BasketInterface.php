<?php

namespace App;

interface BasketInterface
{
    /**
     * Set total
     *
     * @param $total
     */
    public function setTotal($total);

    /**
     * Get total
     *
     * @return int
     */
    public function getTotal();

    /**
     * Get basket items
     *
     * @return mixed
     */
    public function getItems();
}
