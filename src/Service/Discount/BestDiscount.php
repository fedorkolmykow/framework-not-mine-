<?php

declare(strict_types = 1);

namespace Service\Discount;


use Service\User\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Model\Entity\Product;

class BestDiscount
{
    /**
     * Получаем стоимость текущей покупки без скикди
     * @param Product[] $products
     *
     * @return float
     */
    private function getTotalPrice(array $products): float
    {
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product->getPrice();
        }
        return $totalPrice;
    }

    /**
     * Получаем лучшую скидку
     * @param SessionInterface $session
     * @param Product[] $products
     *
     * @return IDiscount
     */
    public function getBestDiscount(SessionInterface $session, array $products): IDiscount
    {
        $discount = new NullObject();
        $maxDiscount = $discount->getDiscount();

        $security = new Security($session);
        if (!$security->isLogged()) {
            return $discount;
        }


        $bigPriceDiscount = new BigPriceDiscount($this->getTotalPrice($products));
        $birthdayDiscount = new BirthdayDiscount($security->getUser());
        $productsDiscount = new ProductsDiscount($products);
        $discounts = [$bigPriceDiscount, $birthdayDiscount, $productsDiscount];


        foreach ($discounts as $d) {
            $discountValue = $d->getDiscount();

            if ($discountValue > $maxDiscount) {
                $maxDiscount = $discountValue;
                $discount = $d;
            }
        }
        return $discount;
    }
}