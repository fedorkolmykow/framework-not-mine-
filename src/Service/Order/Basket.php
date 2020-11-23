<?php

declare(strict_types = 1);

namespace Service\Order;

use Model;
use Service\Billing\Card;
use Service\Billing\IBilling;
use Service\Communication\Email;
use Service\Communication\ICommunication;
use Service\Discount\BestDiscount;
use Service\Discount\BigPriceDiscount;
use Service\Discount\BirthdayDiscount;
use Service\Discount\IDiscount;
use Service\Discount\NullObject;
use Service\Discount\ProductsDiscount;
use Service\User\ISecurity;
use Service\User\Security;
use Service\User\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Basket
{
    /**
     * Сессионный ключ списка всех продуктов корзины
     */
    private const BASKET_DATA_KEY = 'basket';

    /**
     * Сессионный ключ стоимости последней покупки
     */
    public const LAST_PURCHASE_COST = 'costly';

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Добавляем товар в заказ
     *
     * @param int $product
     *
     * @return void
     */
    public function addProduct(int $product): void
    {
        $basket = $this->session->get(static::BASKET_DATA_KEY, []);
        if (!in_array($product, $basket, true)) {
            $basket[] = $product;
            $this->session->set(static::BASKET_DATA_KEY, $basket);
        }
    }

    /**
     * Проверяем, лежит ли продукт в корзине или нет
     *
     * @param int $productId
     *
     * @return bool
     */
    public function isProductInBasket(int $productId): bool
    {
        return in_array($productId, $this->getProductIds(), true);
    }

    /**
     * Получаем информацию по всем продуктам в корзине
     *
     * @return Model\Entity\Product[]
     */
    public function getProductsInfo(): array
    {
        $productIds = $this->getProductIds();
        return $this->getProductRepository()->search($productIds);
    }

    /**
     * Получаем стоимость последней покупки
     *
     * @return float
     */
    public function getLastPurchaseCost(): float
    {
        return $this->session->get(static::LAST_PURCHASE_COST, 0.0);
    }

    /**
     * Получаем стоимость текущей покупки без скикди
     *
     * @return float
     */
    public function getTotalPrice(): float
    {
        $totalPrice = 0;
        foreach ($this->getProductsInfo() as $product) {
            $totalPrice += $product->getPrice();
        }
        return $totalPrice;
    }

    /**
     * Получаем стоимость последней покупки
     *
     * @return IDiscount
     */
    public function getBestDiscount(): IDiscount
    {
        return (new BestDiscount())->getBestDiscount($this->session, $this->getProductsInfo());
    }

    /**
     * Оформление заказа
     *
     * @return void
     */
    public function checkout(): void
    {
        (new Checkout())->checkout($this->session, $this->getProductsInfo());
    }

    /**
     * Фабричный метод для репозитория Product
     *
     * @return Model\Repository\Product
     */
    protected function getProductRepository(): Model\Repository\Product
    {
        return new Model\Repository\Product();
    }

    /**
     * Получаем список id товаров корзины
     *
     * @return array
     */
    private function getProductIds(): array
    {
        return $this->session->get(static::BASKET_DATA_KEY, []);
    }
}
