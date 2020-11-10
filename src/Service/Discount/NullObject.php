<?php

declare(strict_types = 1);

namespace Service\Discount;

class NullObject implements IDiscount
{
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
        return 0;
    }
}
