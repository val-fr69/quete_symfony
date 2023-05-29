<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{

    public const SEASONS = [
        [
            'number' => '1',
            'year' => '2023',
            'description' => 'Préface',
            'program' => 'Black Knight',
            'title' => '1'
        ],

        [
            'number' => '1',
            'year' => '1999',
            'description' => 'East Blue',
            'program' => 'OnePiece',
            'title' => '2'
        ],

        [
            'number' => '2',
            'year' => '2000',
            'description' => 'Alabasta',
            'program' => 'OnePiece',
            'title' => '6'
        ],

        [
            'number' => '3',
            'year' => '2002',
            'description' => 'Île céleste',
            'program' => 'OnePiece',
            'title' => '7'
        ],

        [
            'number' => '1',
            'year' => '2019',
            'description' => 'Kimetsu no Yaiba',
            'program' => 'DemonSlayer',
            'title' => '3'
        ],

        [
            'number' => '1',
            'year' => '2011',
            'description' => 'Le royaume des Sept Couronnes',
            'program' => 'Game of Thrones',
            'title' => '4'
        ],

        [
            'number' => '1',
            'year' => '2010',
            'description' => 'Préface',
            'program' => 'The Walking Dead',
            'title' => '5'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $seasonData) {
            $season = new Season();
            $season->setNumber($seasonData['number']);
            $season->setYear($seasonData['year']);
            $season->setDescription($seasonData['description']);
            $season->setProgram($this->getReference('program_' . $seasonData['program']));
            $this->addReference('season_' . $seasonData['title'], $season);
            $manager->persist($season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
