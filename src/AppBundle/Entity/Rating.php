<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Rating")
 */
class Rating {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	private $id;


    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="ratings")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
	private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Movie", inversedBy="ratings")
     * @ORM\JoinColumn(name="movie", referencedColumnName="id")
     */
	private $movie;
	
    /**
     * @ORM\Column(type="integer")
     */
	private $rating;
	

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
     * Set rating
     *
     * @param integer $rating
     *
     * @return Rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Rating
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
     * Set user
     * @param \AppBundle\Entity\Movie $movie
     *
     * @return Movie
     */
    public function setMovie(\AppBundle\Entity\Movie $movie = null)
    {
    	$this->movie = $movie;
    
    	return $this;
    }
    
    /**
     * Get movie
     *
     * @return \AppBundle\Entity\Movie
     */
    public function getMovie()
    {
    	return $this->movie;
    }
    
}
