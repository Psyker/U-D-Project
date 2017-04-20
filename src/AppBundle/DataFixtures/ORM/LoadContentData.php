<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ContentBlock;
use AppBundle\Entity\Quotes;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadContentData extends AbstractFixture implements FixtureInterface
{

    /**
     * @return array
     */
    private function buildContentBlocks()
    {
        return [
          'Accueil', 'Qui sommes-nous', 'Notre savoir-faire', 'Les chiffres clés', 'Nos partenaires', 'Contact'
        ];
    }

    /**
     * @return array
     */
    private function buildQuotes()
    {
        return [
            ['Théo', 'Bourgoin', 'Developer', 'U Pro', 'La citation de Théo'],
            ['Hugo', 'Sonet', 'UX Designer', 'Jseap', "J'adore les femmes"],
            ['Wladimir', 'Delenclos', 'UX Designer', 'JseapNonplus', "mon grand-père disait toujours ..."],
            ['Thibaut', 'Marsal', 'Developer', 'MutumLol', 'Bonsoir Paaaaariiiis'],
            ['Renan', 'RouskoffJsepasquoi', 'Developer', 'Russie', "Une citation mashallah."]
        ];
    }


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $contentBlocksData = $this->buildContentBlocks();
        foreach($contentBlocksData as $item) {
            $contentBlock = new ContentBlock();
            $contentBlock->setName($item);
            $manager->persist($contentBlock);
        }

        $quotesData = $this->buildQuotes();
        foreach ($quotesData as $item) {
            $quote = new Quotes();
            $quote->setFirstname($item[0])
                ->setLastname($item[1])
                ->setFunction($item[2])
                ->setCompany($item[3])
                ->setText($item[4]);
            $manager->persist($quote);
        }
        $manager->flush();
    }


}