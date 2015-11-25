<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Comment {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var $body The body
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @var \DateTime $date The date
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @var Repo $repo The repository
     *
     * @ORM\ManyToOne(targetEntity="Repo",inversedBy="comments", cascade={"persist"})
     * @ORM\JoinColumn()
     */
    private $repo;

    /**
     * @var \Keynetic\UserBundle\Entity\User $user The user
     *
     * @ORM\ManyToOne(targetEntity="Keynetic\UserBundle\Entity\User",inversedBy="comments")
     * @ORM\JoinColumn()
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Comment
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Comment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set repo
     *
     * @param \AppBundle\Entity\Repo $repo
     *
     * @return Comment
     */
    public function setRepo(\AppBundle\Entity\Repo $repo = null)
    {
        $this->repo = $repo;

        return $this;
    }

    /**
     * Get repo
     *
     * @return \AppBundle\Entity\Repo
     */
    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * Set user
     *
     * @param \Keynetic\UserBundle\Entity\User $user
     *
     * @return Comment
     */
    public function setUser(\Keynetic\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Keynetic\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
