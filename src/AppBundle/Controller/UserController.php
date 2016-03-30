<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Movie;
use AppBundle\Entity\Rating;

class UserController extends Controller
{
    /**
     * @Route("/users", name="_userList")
     */
    public function userList()
    {
    	
    	$users = $this->getDoctrine()
    	->getRepository('AppBundle:User')
    	->findAll();
    	
    	$html = $this->container->get('templating')->render(
            'imdb/userlist.html.twig',
            array('users' => $users)
        );

        return new Response($html);
    }

    /**
     * @Route("/users/{slug}", name="_userDetail")
     */
    public function userDetail($slug)
    {
    	
    	$user = $this->getDoctrine()
    	->getRepository('AppBundle:User')
    	->findOneBySlug($slug);
    	
    	$html = $this->container->get('templating')->render(
            'imdb/userdetail.html.twig',
            array('user' => $user)
        );

        return new Response($html);
    }

    /**
     * @Route("/users/{slug}/fetch", name="_fetchRatings")
     */
    public function fetchRatings($slug)
    {
    	
    	$user = $this->getDoctrine()
    	->getRepository('AppBundle:User')
    	->findOneBySlug($slug);
    	
    	$url = sprintf("http://rss.imdb.com/user/ur%d/ratings", $user->getImdbId());
    	$rss = file_get_contents($url);
    	$data = simplexml_load_string($rss);
    	
    	foreach($data->channel->item as $moviedata)
    	{
    		preg_match("/^(.+) \(([0-9]{4}).*\)/", $moviedata->title, $matches);
    		$title = $matches[1];
    		$year = $matches[2];
    		preg_match("/.+ rated this ([0-9]+)\./", $moviedata->description, $matches);
    		$movieRating = $matches[1];
    		preg_match("/.+imdb\.com\/title\/tt([0-9]+)/", $moviedata->guid, $matches);
    		$imdbId = $matches[1];

        	$em = $this->getDoctrine()->getManager();
        	
    		// check if movie exists in DB, if so get it, otherwise insert
    	    $movie = $this->getDoctrine()
    	    ->getRepository('AppBundle:Movie')
    	    ->findOneByImdbId($imdbId);
        	if (!$movie)
        	{
    	    	$movie = new Movie();
    		    $movie->setTitle($title);
    		    $movie->setYear($year);
    		    $movie->setImdbId($imdbId);
    	    	$em->persist($movie);
    		    $em->flush();    		
    	    }
    	    
   	    
    	    // check if rating exists, if so update, otherwise insert
    	    $rating = $this->getDoctrine()
    	    ->getRepository('AppBundle:Rating')
    	    ->findOneBy(array('movie' => $movie->getId(), 'user' => $user->getId()));
    	    if (!$rating)
    	    {
    	    	$rating = new Rating();
    	    }
    	  	$rating->setMovie($movie);
    	   	$rating->setRating($movieRating);
    	   	$rating->setUser($user);
    	    $em->persist($rating);
    		$em->flush();    		
    	}
    	
    	
    	$html = "";

        return new Response($html);
    }

}
