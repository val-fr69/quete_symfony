<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    public const EPISODES = [
        [
            'title' => 'Episode 1',
            'number' => '1',
            'synopsis' => '5-8 enquête sur la construction d\'un nouveau district dans une Corée post-apocalyptique. Sa-wol et Seuh-ah sont victimes d\'une attaque soudaine.',
            'season' => '1'
        ],

        [
            'title' => 'Episode 2',
            'number' => '2',
            'synopsis' => 'Seol-ah commence à enquêter sur la récente tragédie. Sa-wol est assailli par la culpabilité. 5-8 découvre l\'éxistence d\'un sinistre et mystérieux complot.',
            'season' => '1'
        ],

        [
            'title' => 'Je suis Luffy ! Celui qui deviendra le roi des pirates ! ',
            'number' => '1',
            'synopsis' => 'Luffy rencontre Kobby, un sous-fifre de l\'équipage d\'Alvida. Luffy annonce à Kobby qu\'il veut devenir le Seigneur des Pirates tandis que Kobby souhaite faire partie de la marine.',
            'season' => '2'
        ],

        [
            'title' => 'Le grand manieur de sabre ! Roronoa Zoro, chasseur de pirates !',
            'number' => '2',
            'synopsis' => 'Luffy se présente devant Zoro après l\'avoir observé plusieurs minutes ; le chasseur de pirates se trouve attaché à un poteau au Q.G de la Marine du village Shells Town, capturé par le Colonel Morgan à la solde de la Marine.',
            'season' => '2'
        ],

        [
            'title' => 'Cruauté',
            'number' => '1',
            'synopsis' => 'Tanjirō Kamado se rend en ville afin de vendre du charbon pour nourrir sa famille. À son retour, il découvre que les siens ont été massacrés, à l\'exception de sa petite sœur Nezuko.',
            'season' => '3'
        ],

        [
            'title' => 'Urokodaki Sakonji, le formateur',
            'number' => '2',
            'synopsis' => 'Sur le conseil de Giyū Tomioka, Tanjirō décide de se rendre chez Sakonji Urokodaki pour y commencer la formation de pourfendeur de démons.',
            'season' => '3'
        ],

        [
            'title' => 'L\'hiver vient ',
            'number' => '1',
            'synopsis' => 'Au delà d\'un gigantesque mur de protection de glace dans le nord de Westeros. Robert Baratheon, le roi, arrive avec son cortège au sud du mur de Winterfell pour demander de l\'aide à son vieil ami Eddard Stark. Dans le même temps, sur un autre continent, les derniers survivants de l\'ancien régime Targaryen sont à la recherche d\'une nouvelle alliance pour reprendre leur royaume de l\'usurpateur roi Robert.',
            'season' => '4'
        ],

        [
            'title' => 'La Route royale',
            'number' => '2',
            'synopsis' => 'Le roi Robert Baratheon et son entourage prennent la direction du Sud avec Eddard Stark et ses filles Sansa et Arya. Sur la route, Arya a des ennuis avec le prince Joffrey, ce qui laisse à Eddard une décision difficile à prendre.',
            'season' => '4'
        ],

        [
            'title' => 'Passé décomposé',
            'number' => '1',
            'synopsis' => 'Après être sorti du coma, Rick se met à la recherche de sa famille; il réalise rapidement que le monde a été dévasté par les morts-vivants; il rencontre en chemin Morgan et Duane, qui lui enseignent les règles de survie.',
            'season' => '5'
        ],

        [
            'title' => 'Tripes',
            'number' => '2',
            'synopsis' => 'Rick parvient à s\'échapper du tank grâce à l\'aide de Glenn, dont il avait entendu la voix à la radio. Rick et Glenn se réunissent avec les compagnons de Glenn, un autre groupe de survivants venus pour se ravitailler au supermarché.',
            'season' => '5'
        ],

    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $episodeData) {
            $episode = new Episode();
            $episode->setTitle($episodeData['title']);
            $episode->setNumber($episodeData['number']);
            $episode->setSynopsis($episodeData['synopsis']);
            $episode->setSeason($this->getReference('season_' . $episodeData['season']));
            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
