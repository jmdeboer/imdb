<?php

namespace AppBundle\Entity;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Movie;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MovieRepository")
 * @ORM\Table(name="Movie")
 */
class Movie extends EntityRepository
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
	private $title;

    /**
     * @ORM\Column(type="integer")
     */
	private $year;

    /**
     * @ORM\Column(type="string")
     */
	private $imdbId;

	/**
	 * @Gedmo\Slug(fields={"title"}, updatable=false)
	 * @ORM\Column(length=128, unique=true)
	 */
	private $slug;
	
    /**
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="movie")
     */
	private $ratings;
	

	public function __construct()
	{
	    $this->ratings = new ArrayCollection();
	}
 
    public function getNumberOfRatings()
    {
        return count($this->ratings);
    }

    private $average_rating;
    
	public function getAverageRating()
    {
	    return $this->average_rating;
	}
    
	public function setAverageRating($rating)
    {
	    $this->average_rating = $rating;
	    return $this;
	}
    
	private $highest_rating;
	
    public function getHighestRating()
    {
	    return $this->highest_rating;
    }
    
    public function setHighestRating($rating)
    {
	    $this->highest_rating = $rating;
	    return $this;
    }
    
    private $lowest_rating;
    
    public function getLowestRating()
    {
	    return $this->lowest_rating;
    }
    
    public function setLowestRating($rating)
    {
	    $this->lowest_rating = $rating;
	    return $this;
    }
    
    public function getImdbLink()
    {
        return(sprintf("http://www.imdb.com/title/%s/", $this->getImdbId()));
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
     * Set title
     *
     * @param string $title
     *
     * @return Movie
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
     * Set imdbId
     *
     * @param integer $imdbId
     *
     * @return Movie
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
     * @return Movie
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
     * Set year
     *
     * @param integer $year
     *
     * @return Movie
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Movie
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

}
