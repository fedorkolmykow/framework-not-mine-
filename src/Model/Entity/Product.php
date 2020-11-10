<?php

declare(strict_types = 1);

namespace Model\Entity;

class Product
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /** based on https://www.tiobe.com/tiobe-index/
     * @var float
     */
    private $rating;

    /**
     * @var float
     */
    private $discount;

    /**
     * @param int $id
     * @param string $name
     * @param float $price
     * @param float $rating
     * @param float $discount
     */
    public function __construct(int $id, string $name, float $price, float $rating, float $discount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->rating = $rating;
        $this->discount = $discount;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'rating' => $this->rating,
        ];
    }
}
