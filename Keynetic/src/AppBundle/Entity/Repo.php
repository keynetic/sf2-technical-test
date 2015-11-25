<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="repoRepository")
 * @ORM\Table()
 */
class Repo
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     */
    protected $id;

    /**
     * @var $name The name
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var Comment $comment The comments
     * @ORM\OneToMany(targetEntity="Comment",mappedBy="repo", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Repo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add comment
     *
     * @param \AppBundle\Entity\Comment $comment
     *
     * @return Repo
     */
    public function addComment(\AppBundle\Entity\Comment $comment)
    {
        if (!$this->comments->contains($this)) {
            $this->comments->add($comment);
        }

        if ($comment->getRepo() !== $this) {
            $comment->setRepo($this);
        }
    }

    /**
     * Remove comment
     *
     * @param \AppBundle\Entity\Comment $comment
     */
    public function removeComment(\AppBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return Repo
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
