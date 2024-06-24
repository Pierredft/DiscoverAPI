<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Author;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        // for ($i =0; $i < 20; $i++) {
        //     $livre = new Book;
        //     $livre->setTitle('Livre' . $i);
        //     $livre->setCoverText('Quatrième de couverture numéro :' . $i);
        //     $manager->persist($livre);
        // }

        $listAuthor = [];
        for ($i = 0; $i < 10; $i++) {
            $author = new Author();
            $author->setFirstName('Prénom' . $i);
            $author->setFirstname('Nom' . $i);
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
