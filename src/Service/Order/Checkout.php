<?php


namespace Service\Order;


use Model\Entity\Product;
use Service\Billing\Card;
use Service\Communication\Email;
use Service\Discount\Discount;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Checkout
{

    /**
     * Оформление заказа
     * @param SessionInterface $session
     * @param Product[] $products
     *
     * @return void
     */
    public function checkout(SessionInterface $session, array $products): void
    {
        // Здесь должна быть некоторая логика выбора способа платежа
        $basketBuilder = new BasketBuilder();
        $basketBuilder->setBilling(new Card());
        $basketBuilder->setSession($session);
        $basketBuilder->setCommunication(new Email());
        $basketBuilder->setDiscount(
            (new Discount())->getBestDiscount($session, $products)
        );
        $basketBuilder->setProducts($products);

        $check = new CheckoutProcess();
        $check->Process($basketBuilder);
    }

}