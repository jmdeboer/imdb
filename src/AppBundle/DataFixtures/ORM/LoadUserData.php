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
		$user->setUsername('jm');
		$user->setEmail('jm@complicated.net');
		$user->setPlainPassword('techno');
		$user->setFullname('Jean-Marie de Boer');
		$user->setImdbId('ur4334960');
		$user->setEnabled(true);
		$user->setRoles(array('ROLE_ADMIN'));
        $manager->persist ($user);
        $manager->flush();

		$user = new User();
		$user->setUsername('kjw');
		$user->setEmail('kjwessing@gmail.com');
		$user->setPlainPassword('imdb');
		$user->setFullname('Kasper J. Wessing');
		$user->setImdbId('ur32078498');
		$user->setEnabled(true);
		$user->setRoles(array('ROLE_ADMIN'));
        $manager->persist ($user);
        $manager->flush();

		$user = new User();
		$user->setUsername('valentijn');
		$user->setEmail('zunxunz@gmail.com');
		$user->setPlainPassword('imdb');
		$user->setFullname('Valentijn de Bouter');
		$user->setImdbId('ur30001724');
		$user->setEnabled(true);
		$user->setRoles(array('ROLE_ADMIN'));
        $manager->persist ($user);
        $manager->flush();
    
 		$user = new User();
		$user->setUsername('gideon');
		$user->setEmail('g@1016.nl');
		$user->setPlainPassword('imdb');
		$user->setFullname('Gideon');
		$user->setImdbId('ur004988');
		$user->setEnabled(true);
		$user->setRoles(array('ROLE_ADMIN'));
        $manager->persist ($user);
        $manager->flush();

    }
}