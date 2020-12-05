<?php


namespace Service\Product;


use Model\Entity\Product;


class SortStrategyID implements ISortStrategy
{
    public function compare(Product $p1, Product $p2): int
    {
        return $p1->getId() > $p2->getId() ;
    }

    public function sort(array &$productList): bool
    {
        return usort($productList, array($this, "compare"));
    }
}