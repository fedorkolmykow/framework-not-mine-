<?php

declare(strict_types = 1);

namespace Model\Entity;

class User
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
     * @var string
     */
    private $birthData;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $passwordHash;

    /**
     * @var Role
     */
    private $role;

    /**
     * @param int $id
     * @param string $name
     * @param string $birthData
     * @param string $login
     * @param string $password
     * @param Role $role
     */
    public function __construct(int $id, string $name, string $birthData, string $login, string $password, Role $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthData = $birthData;
        $this->login = $login;
        $this->passwordHash = $password;
        $this->role = $role;
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
     * @return string
     */
    public function getBirthData(): string
    {
        return $this->birthData;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role->getType() == "admin";
    }
}
