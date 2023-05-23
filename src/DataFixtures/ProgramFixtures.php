<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public const PROGRAMS = [
        ['title' => 'Avatar: The Way of Water', 'synopsis' => 'Jake Sully and Neytiri have become parents.', 'category' => 'Action'],
        ['title' => 'Uncharted', 'synopsis' => 'Nathan Drake is recruited to find the fortune of Ferdinand Magellan.', 'category' => 'Aventure'],
        ['title' => 'The Super Mario Bros', 'synopsis' => 'Mario goes in search of his brother Luigi, who has been captured by their enemy Bowser.', 'category' => 'Animation'],
        ['title' => 'Teen Wolf: The Movie', 'synopsis' => 'Fifteen years after leaving Beacon Hills, Scott McCall runs an animal shelter in Los Angeles.', 'category' => 'Fantastique'],
        ['title' => 'Scream', 'synopsis' => 'Twenty-five years after the peaceful town of Woodsboro was hit by a series of brutal murders.s', 'category' => 'Horreur'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $movie) {
            $program = new Program();
            $program->setTitle($movie['title']);
            $program->setSynopsis($movie['synopsis']);
            $program->setCategory($this->getReference('category_' . $movie['category']));
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
