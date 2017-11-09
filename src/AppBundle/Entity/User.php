<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsersRepository")
 */
class User extends BaseUser
{
    /**
     * @var Announcements
     *
     * @ORM\OneToMany(targetEntity="Announcements", mappedBy="user")
     */
    private $announcements;

    /**
     * @ORM\ManyToMany(targetEntity="Qualifications")
     * @ORM\JoinTable(name="users_qualifications",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="qualification_id", referencedColumnName="id")}
     *      )
     */
    private $qualifications;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->announcements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->qualifications = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Add announcement
     *
     * @param \AppBundle\Entity\Announcements $announcement
     *
     * @return User
     */
    public function addAnnouncement(\AppBundle\Entity\Announcements $announcement)
    {
        $this->announcements[] = $announcement;

        return $this;
    }

    /**
     * Remove announcement
     *
     * @param \AppBundle\Entity\Announcements $announcement
     */
    public function removeAnnouncement(\AppBundle\Entity\Announcements $announcement)
    {
        $this->announcements->removeElement($announcement);
    }

    /**
     * Get announcements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnouncements()
    {
        return $this->announcements;
    }

    /**
     * Add qualification
     *
     * @param \AppBundle\Entity\Qualifications $qualification
     *
     * @return User
     */
    public function addQualification(\AppBundle\Entity\Qualifications $qualification)
    {
        $this->qualifications[] = $qualification;

        return $this;
    }

    /**
     * Remove qualification
     *
     * @param \AppBundle\Entity\Qualifications $qualification
     */
    public function removeQualification(\AppBundle\Entity\Qualifications $qualification)
    {
        $this->qualifications->removeElement($qualification);
    }

    /**
     * Get qualifications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQualifications()
    {
        return $this->qualifications;
    }



}
