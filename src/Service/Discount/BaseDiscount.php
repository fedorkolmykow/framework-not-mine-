<?php

declare(strict_types = 1);

namespace Service\Discount;

class BaseDiscount implements IDiscount
{
    const BIG_DISCOUNT_PRICE = 40000.0;
    const BIG_DISCOUNT = 0.1;

    /**
     * @inheritdoc
     */
    public function getDiscount(): float
    {
        // Скидка отсутствует
        return 0;
    }

    /**
     * Получаем скидку в процентах
     *
     * @param float $totalPrice
     * @return float
     */
    public function getPriceWithDiscount(float $totalPrice): float{
        $discount = 0;
        if($totalPrice > self::BIG_DISCOUNT_PRICE){
            $discount = self::BIG_DISCOUNT;
        }
        if($this->getDiscount() > $discount){
            $discount = $this->getDiscount();
        }
        return $totalPrice - $discount * $totalPrice;
    }
}
