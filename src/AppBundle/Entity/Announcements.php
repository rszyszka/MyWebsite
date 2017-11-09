<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Announcements
 *
 * @ORM\Table(name="announcements")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnnouncementsRepository")
 */
class Announcements
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="announcements")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\ManyToMany(targetEntity="Qualifications")
     * @ORM\JoinTable(name="announcements_qualifications",
     *      joinColumns={@ORM\JoinColumn(name="announcement_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="requirement_id", referencedColumnName="id")}
     *      )
     */
    private $requirements;

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Announcements
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Announcements
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->requirements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Announcements
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add requirement
     *
     * @param \AppBundle\Entity\Qualifications $requirement
     *
     * @return Announcements
     */
    public function addRequirement(\AppBundle\Entity\Qualifications $requirement)
    {
        $this->requirements[] = $requirement;

        return $this;
    }

    /**
     * Remove requirement
     *
     * @param \AppBundle\Entity\Qualifications $requirement
     */
    public function removeRequirement(\AppBundle\Entity\Qualifications $requirement)
    {
        $this->requirements->removeElement($requirement);
    }

    /**
     * Get requirements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    public function __toString()
    {
        return $this->title;
    }


}
