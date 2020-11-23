<?php


namespace Service\Order;


use Service\User\Security;

class CheckoutProcess
{

    /**
     * Проведение всех этапов заказа
     *
     * @param BasketBuilder
     * @return void
     */
    public function process(BasketBuilder $basketBuilder){
        $totalPrice = 0;
        foreach ($basketBuilder->getProducts() as $product) {
            $totalPrice += $product->getPrice();
        }

        $totalPrice = $totalPrice - $totalPrice * $basketBuilder->getDiscount()->getDiscount();

        $basketBuilder->getBilling()->pay($totalPrice);
        $user = (new Security($basketBuilder->getSession()))->getUser();
        $basketBuilder->getSession()->set(Basket::LAST_PURCHASE_COST, $totalPrice);

        $basketBuilder->getCommunication()->process($user, 'checkout_template');
    }

}