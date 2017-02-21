<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Traits\TimeStampTrait;

/**
 * Class Log
 *
 * @ORM\Table(name="log")
 * @ORM\Entity()
 */
class Log
{
    use TimeStampTrait;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;

//    /**
//     * @var User
//     *
//     * @ORM\ManyToOne(targetEntity="User")
//     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
//     */
//    private $user;

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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Log
     */
    public function setType(
        string $type
    ): Log {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return Log
     */
    public function setMessage(
        string $message
    ): Log {
        $this->message = $message;

        return $this;
    }

//    /**
//     * @return string
//     */
//    public function getUser(): string
//    {
//        return $this->user;
//    }
//
//    /**
//     * @param string $user
//     *
//     * @return Log
//     */
//    public function setUser(string $user): Log
//    {
//        $this->user = $user;
//
//        return $this;
//    }
}
