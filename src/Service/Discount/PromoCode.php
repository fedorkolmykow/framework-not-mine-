<?php

declare(strict_types = 1);

namespace Service\Discount;

class PromoCode extends BaseDiscount
{
    /**
     * @var string
     */
    private $promoCode;

    /**
     * @param string $promoCode
     */
    public function __construct(string $promoCode)
    {
        $this->promoCode = $promoCode;
    }

    /**
     * @inheritdoc
     */
    public function getDiscount(): float
    {
        // Получаем по промокоду размер скидки на заказ в процентах
        // $discount = $this->find($this->promoCode)->discount();
        $discount = 0.055;

        // Запрос в систему хранения промокодов для пометки кода как использованный
        // $this->find($this->promoCode)->deactivate();

        return $discount;
    }
}
