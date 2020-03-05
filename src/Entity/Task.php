<?php

namespace Taskholder\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Taskholder\Boundary\EmailBoundary;
use Taskholder\Boundary\ImageBoundary;
use Taskholder\Boundary\UsernameBoundary;

/**
 * @Entity
 * @Table(name="task")
 */
class Task extends BaseEntity
{
    /** @Column(type="string") */
    private $username;

    /** @Column(type="string") */
    private $email;

    /** @Column(type="string") */
    private $content;

    /** @Column(type="string")  */
    private $imgPath;

    /** @Column(type="boolean")  */
    private $completed = false;

    public function __construct(UsernameBoundary $username, EmailBoundary $email, string $content, ImageBoundary $image)
    {
        parent::__construct();

        $this->username = $username->__toString();
        $this->email = $email->__toString();
        $this->content = $content;
        $this->imgPath = $image->__toString();
    }

    public static function orderable(): array
    {
        return [
            'username',
            'email',
            'content'
        ];
    }

    public function jsonSerialize()
    {
        return [
            'username'  => $this->username,
            'email'     => $this->email,
            'content'   => $this->content,
            'imgpath'   => $this->imgPath,
            'completed' => $this->completed
        ];
    }

}