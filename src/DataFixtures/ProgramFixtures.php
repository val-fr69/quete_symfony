<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public const PROGRAMS = [
        ['title' => 'Black Knight', 'synopsis' => 'En 2071, le monde a été ravagé par la pollution de l\'air. La survie de l\'humanité dépend de livreurs atypiques surnommés les "chevaliers noirs"', 'country' => 'Corée du Sud', 'year' => '2023', 'category' => 'Action'],
        ['title' => 'OnePiece', 'synopsis' => 'Monkey D.Luffy cherche à devenir le nouveau roi des Pirates et retrouver le fameux OnePiece ! ', 'country' => 'Japon', 'year' => '1999', 'category' => 'Aventure'],
        ['title' => 'DemonSlayer', 'synopsis' => 'Tanjiro rejoint les pourfendeurs et part à la recherche des lunes supérieurs pour venger sa famille', 'country' => 'Japon', 'year' => '2019', 'category' => 'Animation'],
        ['title' => 'Game of Thrones', 'synopsis' => 'Après un été de dix années, un hiver rigoureux s\'abat sur le Royaume avec la promesse d\'un avenir des plus sombres. Pendant ce temps, complots et rivalités se jouent sur le continent pour s\'emparer du Trône de Fer, le symbole du pouvoir absolu.', 'country' => 'Etats-Unis', 'year' => '2011', 'category' => 'Fantastique'],
        ['title' => 'The Walking Dead', 'synopsis' => 'L histoire suit les aventures du shériff Rick Grimes, qui se réveille après à un coma au milieu d une envahison de zombies', 'country' => 'Etats-Unis', 'year' => '2010', 'category' => 'Horreur'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $movie) {
            $program = new Program();
            $program->setTitle($movie['title']);
            $program->setSynopsis($movie['synopsis']);
            $program->setCountry($movie['country']);
            $program->setYear($movie['year']);
            $program->setCategory($this->getReference('category_' . $movie['category']));
            $this->addReference('program_' . $movie['title'], $program);
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
