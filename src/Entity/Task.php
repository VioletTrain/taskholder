<?php

namespace Taskholder\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Taskholder\Boundary\BoolBoundary;
use Taskholder\Boundary\EmailBoundary;
use Taskholder\Boundary\StringBoundary;
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

    public function __construct(UsernameBoundary $username, EmailBoundary $email, string $content, string $imgPath)
    {
        parent::__construct();

        $this->username = $username->__toString();
        $this->email = $email->__toString();
        $this->content = $content;
        $this->imgPath = $imgPath;
    }

    public function setContent(StringBoundary $content): self
    {
        $this->content = $content->getString();

        return $this;
    }

    public function setCompleted(BoolBoundary $completed): self
    {
        $this->completed = $completed->getBool();

        return $this;
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
            'id'        => $this->id,
            'username'  => $this->username,
            'email'     => $this->email,
            'content'   => $this->content,
            'imgpath'   => $this->imgPath,
            'completed' => $this->completed
        ];
    }

}