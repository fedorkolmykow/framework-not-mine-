<?php

declare(strict_types = 1);

namespace Service\Discount;

use Model;

class ProductsDiscount implements IDiscount
{
    /**
     * @var Model\Entity\Product[]
     */
    private $products;

    /**
     * @param Model\Entity\Product[] $products
     */
    public function __construct(array $products)
    {
        $this->products = $products;
    }

    /**
     * @inheritdoc
     */
    public function getDiscount(): float
    {
        $discountPrice = 0;
        $totalPrice = 0;
        foreach ($this->products as $key => $product) {
            $discountPrice += $product->getDiscount() * $product->getPrice();
            $totalPrice += $product->getPrice();
        }
        if ($totalPrice == 0) {
            return 0;
        }
        return $discountPrice/$totalPrice;
    }
}
