<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\User;
use App\Entity\Author;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("user@bookapi.com");
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword($this->userPasswordHasher->hashPassword($user,"password"));
        $manager->persist($user);
        
        $userAdmin = new User();
        $userAdmin->setEmail("admin@bookapi.com");
        $userAdmin->setRoles(["ROLE_ADMIN"]);
        $userAdmin->setPassword($this->userPasswordHasher->hashPassword($userAdmin,"password"));
        $manager->persist($userAdmin);
        $this->userPasswordHasher->hashPassword($userAdmin,"password");
        
        $listAuthor = [];
        for ($i = 0; $i < 10; $i++) {
            $author = new Author();
            $author->setFirstName('Prénom' . $i);
            $author->setFirstName('Nom' . $i);
            $manager->persist($author);
            $listAuthor[] = $author;
        }
        for ($i =0; $i < 20; $i++) {
                $livre = new Book;
                $livre->setTitle('Titre' . $i);
                $livre->setCoverText('Quatrième de couverture numéro :' . $i);
                $livre->setAuthor($listAuthor[array_rand($listAuthor)]);
                $manager->persist($livre);
            }
        $manager->flush();
    }
}
