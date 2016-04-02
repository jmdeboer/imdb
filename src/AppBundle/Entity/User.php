<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 * @ORM\Table(name="`User`")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;

    /**
     * @ORM\Column(type="string")
     */
	private $fullname;
	
    /**
     * @ORM\Column(type="string", nullable=true)
     */
	private $imdbUsername;

	/**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Please enter your IMDB id.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The IMDB id is too short.",
     *     maxMessage="The IMDB id is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
	private $imdbId;

    /**
     * @Gedmo\Slug(fields={"username"}, updatable=false)
     * @ORM\Column(unique=true)
     */
	private $slug;
	
    /**
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="user")
     */
	private $ratings;

    public function __construct()
    {
        parent::__construct();
        $this->ratings = new ArrayCollection();
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     *
     * @return User
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set imdbId
     *
     * @param integer $imdbId
     *
     * @return User
     */
    public function setImdbId($imdbId)
    {
        $this->imdbId = $imdbId;

        return $this;
    }

    /**
     * Get imdbId
     *
     * @return integer
     */
    public function getImdbId()
    {
        return $this->imdbId;
    }

    /**
     * Add rating
     *
     * @param \AppBundle\Entity\Rating $rating
     *
     * @return User
     */
    public function addRating(\AppBundle\Entity\Rating $rating)
    {
        $this->ratings[] = $rating;

        return $this;
    }

    /**
     * Remove rating
     *
     * @param \AppBundle\Entity\Rating $rating
     */
    public function removeRating(\AppBundle\Entity\Rating $rating)
    {
        $this->ratings->removeElement($rating);
    }

    /**
     * Get ratings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set imdbUsername
     *
     * @param string $imdbUsername
     *
     * @return User
     */
    public function setImdbUsername($imdbUsername)
    {
        $this->imdbUsername = $imdbUsername;

        return $this;
    }

    /**
     * Get imdbUsername
     *
     * @return string
     */
    public function getImdbUsername()
    {
        return $this->imdbUsername;
    }
}
