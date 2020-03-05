<?php

namespace Taskholder\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Framework\Contract\Authenticatable;

/**
 * @Entity
 * @Table(name="admin")
 */
class Admin extends BaseEntity implements Authenticatable
{
    /** @Column(type="string") */
    private $login;

    /** @Column(type="string") */
    private $password;

    public function __construct(string $login)
    {
        parent::__construct();
        $this->login = $login;
    }

    public function jsonSerialize()
    {
        return [
            'login' => $this->login
        ];
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}