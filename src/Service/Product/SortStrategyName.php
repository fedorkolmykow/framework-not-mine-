<?php


namespace Service\Product;


use Model\Entity\Product;

class SortStrategyName implements ISortStrategy
{
    public function compare(Product $p1, Product $p2): int
    {
        return strcmp($p1->getName(), $p2->getName());
    }

    public function sort(array &$productList): bool
    {
        return usort($productList, array($this, "compare"));
    }
}
