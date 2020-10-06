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
            $productList[] = new Entity\Product($item['id'], $item['name'], $item['price']);
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
            $productList[] = new Entity\Product(
                $item['id'],
                $item['name'],
                $item['price'],
                $item['rating']
            );
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
        $dataSource = [
            [
                'id' => 1,
                'name' => 'PHP',
                'price' => 15300,
                'rating' => 2.09,
            ],
            [
                'id' => 2,
                'name' => 'Python',
                'price' => 20400,
                'rating' => 11.28,
            ],
            [
                'id' => 3,
                'name' => 'C#',
                'price' => 30100,
                'rating' => 4.16,
            ],
            [
                'id' => 4,
                'name' => 'Java',
                'price' => 30600,
                'rating' => 12.56,
            ],
            [
                'id' => 5,
                'name' => 'Ruby',
                'price' => 18600,
                'rating' => 1.16,
            ],
            [
                'id' => 8,
                'name' => 'Delphi',
                'price' => 8400,
                'rating' => 0.71,
            ],
            [
                'id' => 9,
                'name' => 'C++',
                'price' => 19300,
                'rating' => 6.94,
            ],
            [
                'id' => 10,
                'name' => 'C',
                'price' => 12800,
                'rating' => 16.95,
            ],
            [
                'id' => 11,
                'name' => 'Lua',
                'price' => 5000,
                'rating' => 0.35,
            ],
            [
                'id' => 12,
                'name' => 'Rust',
                'price' => 100500,
                'rating' => 0.68,
            ],
        ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return in_array($dataSource[key($search)], current($search), true);
        };

        return array_filter($dataSource, $productFilter);
    }
}
