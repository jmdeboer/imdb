<?php
// src/AppBundle/DataFixtures/ORM/LoadUserData.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
	{
		$user = new User();
		$user->setUsername('j-m-d-b');
		$user->setFullname('Jean-Marie de Boer');
		$user->setImdbId(4334960);
		
		$manager->persist ($user);
		$manager->flush ();
	}
}