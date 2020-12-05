<?php


namespace Service\Product;


use Model\Entity\Product;


class SortStrategyPrice implements ISortStrategy
{
    public function compare(Product $p1, Product $p2): int
    {
        return $p1->getPrice() > $p2->getPrice() ;
    }

    public function sort(array &$productList): bool
    {
        return usort($productList, array($this, "compare"));
    }
}