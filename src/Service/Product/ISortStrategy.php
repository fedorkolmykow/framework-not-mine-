<?php


namespace Service\Product;

use Model\Entity\Product;

interface ISortStrategy
{
    /**
     * Сравниваем два продукта
     *
     * @param Product $p1
     * @param Product $p2
     * @return int
     */
    public function compare(Product $p1,Product $p2): int;

    /**
     * Сортируем список продуктов
     *
     * @param Product[] $productList
     *
     * @return bool
     */
    public function sort(array &$productList): bool;

}