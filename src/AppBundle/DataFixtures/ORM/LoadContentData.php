<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ContentBlock;
use AppBundle\Entity\Quotes;
use AppBundle\Entity\TextBlock;
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
          'Accueil', 'Les chiffres clés', 'Nos métiers', 'Nos partenaires', 'Contact', 'Mentions légales'
        ];
    }

    private function buildTextBlocks()
    {
        return [
            [1, 'texte_accueil', 'U&D, spécialiste du BTP.', 'Acteur majeur en Ile-de-France, U&D vous accompagne depuis 2012 dans vos projet de gros oeuvres, en isolation et en étanchéité.', null],
            [2, 'titre_chiffres' ,'Notre activité en quelques chiffres ', null, null],
            [2, 'chiffre_cle_1' ,34,'Clients nous ont déjà fait confiance dans leur réalisation de gros oeuvre', null],
            [2, 'chiffre_cle_2' ,27, 'Organismes différents nous accréditent en isolation et gros oeuvres', 1],
            [2, 'chiffre_cle_3' ,165, 'Fournisseurs de matériaux s’engagent à nos côtés pour vous proposer les meilleurs prix', 2],
            [2, 'chiffre_cle_4' ,340, 'Certifications encadrent notre activité et attestent de notre savoir faire.', 3],
            [3, 'titre_metier' ,'Nos métiers', null, null],
            [3, 'metier_1' ,'Isolation', 'Accrédité ACERMI U&D met en oeuvre tous les moyens technique et son savoir faire pour répondre aux besoins environnementaux et énergétique', 1],
            [3, 'metier_2' ,'Devoir de conseil', 'L’accompagnement et le conseil font partis de l’ADN de U&D. Demandez un devis par téléphone directement depuis notre plateforme.', 2],
            [3, 'metier_3' ,'Gros oeuvre', 'Accrédité par le Cofrac, U&D répond à vos projets de gros oeuvre et met en oeuvre les moyens techniques pour le faire, (pelteuse de chantier etc ...)', 3],
            [3, 'paragraphe_metier' ,'Une expertise au service de vos projets', 'Le savoir-faire de U&D se conjuge à une expertise importante en isolation grace aux diférentes accréditations énergétiques. Découvrez notre gamme d’expertises.', null],
            [4, 'texte_partenaire','Ils nous font confiance', 'Fort d’un réseau de clients et de partenaires important, U&D travail et collabore avec un réseau de plus nombreux professionnel du batiment et de l’isolation.Ce réseau est rendu possible par notre accréditation ACERMI .', null],
            [5, 'text_contact' ,'Rentrons en contact',null, null]
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
        $textBlocksData = $this->buildTextBlocks();
        foreach($contentBlocksData as $item) {
            $contentBlock = new ContentBlock();
            $contentBlock->setName($item);
           $manager->persist($contentBlock);
           $manager->flush();
           foreach ($textBlocksData as $text) {
               if ($text[0] == $contentBlock->getId()) {
                   $textBlock = new TextBlock();
                   $textBlock->setName($text[1])
                       ->setTitle($text[2])
                       ->setContent($text[3])
                       ->setContentBlock($contentBlock)
                       ->setPosition($text[4]);
                   $manager->persist($textBlock);
               }
           }
        }

        $quotesData = $this->buildQuotes();
        foreach ($quotesData as $item) {
            $quote = new Quotes();
            $quote->setFirstname($item[0])
                ->setLastname($item[1])
                ->setFunction($item[2])
                ->setCompany($item[3])
                ->setText($item[4])
                ->setCreatedAt(new \DateTime());
            $manager->persist($quote);
        }
        $manager->flush();
    }


}