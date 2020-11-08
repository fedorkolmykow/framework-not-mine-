<?php

declare(strict_types = 1);

namespace Model\Repository;

use Model\Entity;

class User
{
    /**
     * Получаем пользователя по идентификатору
     *
     * @param int $id
     * @return Entity\User|null
     */
    public function getById(int $id): ?Entity\User
    {
        foreach ($this->getDataFromSource(['id' => $id]) as $user) {
            return $this->createUser($user);
        }

        return null;
    }

    /**
     * Получаем пользователя по логину
     *
     * @param string $login
     * @return Entity\User
     */
    public function getByLogin(string $login): ?Entity\User
    {
        foreach ($this->getDataFromSource(['login' => $login]) as $user) {
            if ($user['login'] === $login) {
                return $this->createUser($user);
            }
        }

        return null;
    }

    /**
     * Получаем всех пользователей
     *
     * @return Entity\User[]
     */
    public function fetchAll(): array
    {
        $userList = [];
        foreach ($this->getDataFromSource() as $item) {
            $userList[] = new Entity\User(
                $item['id'],
                $item['name'],
                $item['birthDate'],
                $item['login'],
                $item['password'],
                new Entity\Role(
                    $item['role']['id'],
                    $item['role']['title'],
                    $item['role']['role']
                )
            );
        }

        return $userList;
    }

    /**
     * Фабрика по созданию сущности пользователя
     *
     * @param array $user
     * @return Entity\User
     */
    private function createUser(array $user): Entity\User
    {
        $role = $user['role'];

        return new Entity\User(
            $user['id'],
            $user['name'],
            $user['birthDate'],
            $user['login'],
            $user['password'],
            new Entity\Role($role['id'], $role['title'], $role['role'])
        );
    }

    /**
     * Получаем пользователей из источника данных
     *
     * @param array $search
     *
     * @return array
     */
    private function getDataFromSource(array $search = [])
    {
        $admin = ['id' => 1, 'title' => 'Super Admin', 'role' => 'admin'];
        $user = ['id' => 1, 'title' => 'Main user', 'role' => 'user'];
        $test = ['id' => 1, 'title' => 'For test needed', 'role' => 'test'];

        $dataSource = [
            [
                'id' => 1,
                'name' => 'Super Admin',
                'birthDate' => date("m.d.y", mktime(0, 0, 0, 7, 1, 2000)),
                'login' => 'root',
                'password' => '$2y$10$GnZbayyccTIDIT5nceez7u7z1u6K.znlEf9Jb19CLGK0NGbaorw8W', // 1234
                'role' => $admin
            ],
            [
                'id' => 2,
                'name' => 'Doe John',
                'birthDate' => date("m.d.y", mktime(0, 0, 0, 1, 23, 1985)),
                'login' => 'doejohn',
                'password' => '$2y$10$j4DX.lEvkVLVt6PoAXr6VuomG3YfnssrW0GA8808Dy5ydwND/n8DW', // qwerty
                'role' => $user
            ],
            [
                'id' => 3,
                'name' => 'Ivanov Ivan Ivanovich',
                'birthDate' => date("m.d.y", mktime(0, 0, 0, 1, 1, 2005)),
                'login' => 'i**3',
                'password' => '$2y$10$TcQdU.qWG0s7XGeIqnhquOH/v3r2KKbes8bLIL6NFWpqfFn.cwWha', // PaSsWoRd
                'role' => $user
            ],
            [
                'id' => 4,
                'name' => 'Test Testov Testovich',
                'birthDate' => date("m.d.y", mktime(0, 0, 0, 3, 30, 1952)),
                'login' => 'testok',
                'password' => '$2y$10$vQvuFc6vQQyon0IawbmUN.3cPBXmuaZYsVww5csFRLvLCLPTiYwMa', // testss
                'role' => $test
            ],
            [
                'id' => 5,
                'name' => 'Kolmykow Fedor Alekseevich',
                'birthDate' => date("m.d.y", mktime(0, 0, 0, 1, 9, 1997)),
                'login' => 'student',
                'password' => '$2y$10$sq9zfEQMizwVvDKgepifB.HH8hB4ydfp830FE5UNPHXKfivhEko4a', // MyPassword
                'role' => $user
            ],
        ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return (bool) array_intersect_assoc($dataSource, $search);
        };

        return array_filter($dataSource, $productFilter);
    }
}
