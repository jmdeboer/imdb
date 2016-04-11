<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Movie;

class MovieController extends Controller
{
    /**
     * @Route("/movies", name="_movieList")
     */
    public function movieList()
    {
    	
    	$movies = $this->getDoctrine()
    	->getRepository('AppBundle:Movie')
    	->findAll();
    	
    	$html = $this->container->get('templating')->render(
            'imdb/movielist.html.twig',
            array('movies' => $movies)
        );

        return new Response($html);
    }

    /**
     * @Route("/movies/{slug}", name="_movieDetail")
     */
    public function movieDetail($slug)
    {
    	
    	$movie = $this->getDoctrine()
    	->getRepository('AppBundle:Movie')
    	->findOneBySlug($slug);
    	
    	$conn = $this->get('database_connection');
    	$m = $conn->fetchAll('SELECT round(avg(rating), 1) as avg, max(rating) as max, min(rating) as min FROM Rating where movie = ' . $movie->getId());
    	$movie->setAverageRating($m[0]['avg']);
    	$movie->setHighestRating($m[0]['max']);
    	$movie->setLowestRating($m[0]['min']);
    	
    	$html = $this->container->get('templating')->render(
            'imdb/moviedetail.html.twig',
            array('movie' => $movie)
        );

        return new Response($html);
    }


}
