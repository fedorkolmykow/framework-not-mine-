<?php

declare(strict_types = 1);

namespace Service\Order;


use Model\Entity\Product;
use Service\Billing\IBilling;
use Service\Communication\ICommunication;
use Service\Discount\IDiscount;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BasketBuilder
{
    /**
     * @var Product[]
     */
    private $products;

    /**
     * @var IDiscount
     */
    private $discount;

    /**
     * @var IBilling
     */
    private $billing;

    /**
     * @var ICommunication
     */
    private $communication;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->session;
    }

    /**
     * @param SessionInterface $session
     */
    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    /**
     * @return IDiscount
     */
    public function getDiscount(): IDiscount
    {
        return $this->discount;
    }

    /**
     * @param IDiscount $discount
     */
    public function setDiscount(IDiscount $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return IBilling
     */
    public function getBilling(): IBilling
    {
        return $this->billing;
    }

    /**
     * @param IBilling $billing
     */
    public function setBilling(IBilling $billing): void
    {
        $this->billing = $billing;
    }

    /**
     * @return ICommunication
     */
    public function getCommunication(): ICommunication
    {
        return $this->communication;
    }

    /**
     * @param ICommunication $communication
     */
    public function setCommunication(ICommunication $communication): void
    {
        $this->communication = $communication;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

}