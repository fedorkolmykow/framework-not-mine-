<?php

declare(strict_types = 1);

namespace Service\Discount;

class BigPriceDiscount implements IDiscount
{
    const BIG_DISCOUNT_PRICE = 40000.0;
    const BIG_DISCOUNT = 0.1;

    /**
     * @inheritdoc
     */
    public function getDiscount(): float
    {
        $discount = 0;
        if ($this->totalPrice > self::BIG_DISCOUNT_PRICE) {
            $discount = self::BIG_DISCOUNT;
        }
        return $discount;
    }

    /**
     * @var float
     */
    private $totalPrice;

    /**
     * @param float $totalPrice
     */
    public function __construct(float $totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }
}
