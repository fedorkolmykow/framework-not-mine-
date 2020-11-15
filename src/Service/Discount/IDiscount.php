<?php

declare(strict_types = 1);

namespace Service\Discount;

interface IDiscount
{
    /**
     * Получаем скидку дробью
     *
     * @return float
     */
    public function getDiscount(): float;
}
