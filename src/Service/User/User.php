<?php

declare(strict_types = 1);

namespace Service\User;
use Model;

class User
{

    /**
     * Получаем всех пользователей
     *
     * @return Model\Entity\User[]
     */
    public function getAll(): array
    {
        return $this->getUserRepository()->fetchAll();
    }

    /**
     * Фабричный метод для репозитория User
     *
     * @return Model\Repository\User
     */
    protected function getUserRepository(): Model\Repository\User
    {
        return new Model\Repository\User();
    }
}