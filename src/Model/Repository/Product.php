<?php

declare(strict_types = 1);

namespace Model\Repository;

use Model\Entity;

class Product
{
    /**
     * Поиск продуктов по массиву id
     *
     * @param int[] $ids
     * @return Entity\Product[]
     */
    public function search(array $ids = []): array
    {
        if (!count($ids)) {
            return [];
        }
        $productList = [];
        foreach ($this->getDataFromSource(['id' => $ids]) as $item) {
            $productList[] = clone $item;
        }

        return $productList;
    }

    /**
     * Получаем все продукты
     *
     * @return Entity\Product[]
     */
    public function fetchAll(): array
    {
        $productList = [];
        foreach ($this->getDataFromSource() as $item) {
            $productList[] = clone $item;
        }

        return $productList;
    }

    /**
     * Получаем продукты из источника данных
     *
     * @param array $search
     *
     * @return array
     */
    private function getDataFromSource(array $search = [])
    {
        $dataSource = array(
            new Entity\Product(1, 'PHP', 15300, 2.09),
            new Entity\Product(2, 'Python', 20400, 11.28),
            new Entity\Product(3, 'C#', 30100, 4.16),
            new Entity\Product(4, 'Java', 30600, 12.56),
            new Entity\Product(5, 'Ruby', 18600, 1.16),
            new Entity\Product(8, 'Delphi', 8400, 0.71, 0.08),
            new Entity\Product(9, 'C++', 19300, 6.94),
            new Entity\Product(10, 'C', 12800, 16.95),
            new Entity\Product(11, 'Lua', 5000, 0.35),
            new Entity\Product(12, 'Rust', 100500, 0.68),
        );

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (Entity\Product $product) use ($search): bool {
            var_dump(current($search));

            return $product->getId() == current($search);
        };

        return array_filter($dataSource, $productFilter);
    }
}
