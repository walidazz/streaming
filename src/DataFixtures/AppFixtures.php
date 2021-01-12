<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Episode;
use App\Entity\Genre;
use App\Entity\Saison;
use App\Entity\Serie;
use Cocur\Slugify\Slugify;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $slugify = new  Slugify();
        $content = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit aliquam iusto repudiandae ex? Magni corporis blanditiis, error veritatis beatae voluptas est earum necessitatibus amet enim, aliquam optio sunt ratione quasi!
0';

        $episode = new Episode();
        $episode->setNumber(1)
            ->setSlug($slugify->slugify($episode->getNumber()))
            ->setCreatedAt(new DateTime())
            ->setUrl('https://youtu.be/IzoGHKqWDTY');
        $manager->persist($episode);

        $comment = new Comment();
        $comment->setContent('Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit ad dolor, impedit rerum ea aspernatur repellendus, illum tenetur numquam, expedita dolore. Voluptate obcaecati repellendus nisi deleniti quos similique maxime eius.
')
            ->setCreatedAt(new DateTime())
            ->setEmail('walidazzimani@gmail.com')
            ->setLastname('Azzimani')
            ->setEpisodes($episode);
        $manager->persist($comment);



        $genre = new Genre();
        $genre->setName('Horreur');
        $manager->persist($genre);

        $serie = new Serie();
        $serie->setActor(['Jennifer Aniston', 'Brad Pitt', 'Leonardo Dicaprio'])
            ->setDirector('Quentin Tarantino')
            ->addGenre($genre)
            ->setCreatedAt(new DateTime())
            ->setDuration(90)
            ->setName('Viking')
            ->setRating(4.5)
            ->setReleaseDate(new DateTime())
            ->setSynopsis($content)
            ->setCoverImage('https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.ZmupBmheLnEWAfSwIe6k2wHaEK%26pid%3DApi&f=1')
            ->setSlug($slugify->slugify($serie->getName()));

        $manager->persist($serie);

        $saison = new Saison();
        $saison->setNumber(1)
            ->setSeries($serie);
        $manager->persist($saison);

        $manager->flush();
    }
}
