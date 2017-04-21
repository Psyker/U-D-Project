<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Answer;
use AppBundle\Entity\Contact;
use AppBundle\Entity\ContentBlock;
use AppBundle\Entity\Partner;
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
            [2, 'chiffre_cle_1' ,620 ,'Clients nous ont déjà fait confiance dans leur réalisation de gros oeuvre', 1],
            [2, 'chiffre_cle_2' ,27, 'Organismes différents nous accréditent en isolation et gros oeuvres', 2],
            [2, 'chiffre_cle_3' ,165, 'Fournisseurs de matériaux s’engagent à nos côtés pour vous proposer les meilleurs prix', 3],
            [2, 'chiffre_cle_4' ,340, 'Certifications encadrent notre activité et attestent de notre savoir faire.', 4],
            [3, 'titre_metier' ,'Nos métiers', null, null],
            [3, 'metier_1' ,'Isolation', 'Accrédité ACERMI U&D met en oeuvre tous les moyens technique et son savoir faire pour répondre aux besoins environnementaux et énergétique', 1],
            [3, 'metier_2' ,'Devoir de conseil', 'L’accompagnement et le conseil font partis de l’ADN de U&D. Demandez un devis par téléphone directement depuis notre plateforme.', 2],
            [3, 'metier_3' ,'Gros oeuvre', 'Accrédité par le Cofrac, U&D répond à vos projets de gros oeuvre et met en oeuvre les moyens techniques pour le faire, (pelteuse de chantier etc ...)', 3],
            [3, 'paragraphe_metier' ,'Une expertise au service de vos projets', 'Le savoir-faire de U&D se conjuge à une expertise importante en isolation grace aux diférentes accréditations énergétiques. Découvrez notre gamme d’expertises.', null],
            [4, 'texte_partenaire','Ils nous font confiance', 'Fort d’un réseau de clients et de partenaires important, U&D travail et collabore avec un réseau de plus nombreux professionnel du batiment et de l’isolation.Ce réseau est rendu possible par notre accréditation ACERMI .', null],
            [5, 'text_contact' ,'Rentrons en contact',null, null],
            [6, 'text_mentions', 'Mentions légales', "La seule contrepartie à l'utilisation de ces mentions légales, est l'engagement total à laisser le lien crédit subdelirium sur cette page de mentions légales. 

Vos mentions légales :
Informations légales 
1. Présentation du site. 
En vertu de l'article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, il est précisé aux utilisateurs du site uetd.com l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi : 
Propriétaire : Mr U&D – Mr U&D – Adresse de U&D

Créateur : Groupe 9 

Responsable publication : Groupe 9 – Groupe 9

Le responsable publication est une personne physique ou une personne morale.

Webmaster : Groupe 9 – Groupe 9

Hébergeur : HebergeurU&D – HebergeurU&D

Crédits : les mentions légales ont été générées et offertes par Subdelirium Mentions légales 

2. Conditions générales d’utilisation du site et des services proposés. 
L’utilisation du site uetd.com implique l’acceptation pleine et entière des conditions générales d’utilisation ci-après décrites. Ces conditions d’utilisation sont susceptibles d’être modifiées ou complétées à tout moment, les utilisateurs du site uetd.com sont donc invités à les consulter de manière régulière. 
Ce site est normalement accessible à tout moment aux utilisateurs. Une interruption pour raison de maintenance technique peut être toutefois décidée par Mr U&D, qui s’efforcera alors de communiquer préalablement aux utilisateurs les dates et heures de l’intervention. 
Le site uetd.com est mis à jour régulièrement par Groupe 9. De la même façon, les mentions légales peuvent être modifiées à tout moment : elles s’imposent néanmoins à l’utilisateur qui est invité à s’y référer le plus souvent possible afin d’en prendre connaissance. 
3. Description des services fournis. 
Le site uetd.com a pour objet de fournir une information concernant l’ensemble des activités de la société. 
Mr U&D s’efforce de fournir sur le site uetd.com des informations aussi précises que possible. Toutefois, il ne pourra être tenue responsable des omissions, des inexactitudes et des carences dans la mise à jour, qu’elles soient de son fait ou du fait des tiers partenaires qui lui fournissent ces informations. 
Tous les informations indiquées sur le site uetd.com sont données à titre indicatif, et sont susceptibles d’évoluer. Par ailleurs, les renseignements figurant sur le site uetd.com ne sont pas exhaustifs. Ils sont donnés sous réserve de modifications ayant été apportées depuis leur mise en ligne. 
4. Limitations contractuelles sur les données techniques. 
Le site utilise la technologie JavaScript. 
Le site Internet ne pourra être tenu responsable de dommages matériels liés à l’utilisation du site. De plus, l’utilisateur du site s’engage à accéder au site en utilisant un matériel récent, ne contenant pas de virus et avec un navigateur de dernière génération mis-à-jour 
5. Propriété intellectuelle et contrefaçons. 
Mr U&D est propriétaire des droits de propriété intellectuelle ou détient les droits d’usage sur tous les éléments accessibles sur le site, notamment les textes, images, graphismes, logo, icônes, sons, logiciels. 
Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite, sauf autorisation écrite préalable de : Mr U&D. 
Toute exploitation non autorisée du site ou de l’un quelconque des éléments qu’il contient sera considérée comme constitutive d’une contrefaçon et poursuivie conformément aux dispositions des articles L.335-2 et suivants du Code de Propriété Intellectuelle. 
6. Limitations de responsabilité. 
Mr U&D ne pourra être tenue responsable des dommages directs et indirects causés au matériel de l’utilisateur, lors de l’accès au site uetd.com, et résultant soit de l’utilisation d’un matériel ne répondant pas aux spécifications indiquées au point 4, soit de l’apparition d’un bug ou d’une incompatibilité. 
Mr U&D ne pourra également être tenue responsable des dommages indirects (tels par exemple qu’une perte de marché ou perte d’une chance) consécutifs à l’utilisation du site uetd.com . 
Des espaces interactifs (possibilité de poser des questions dans l’espace contact) sont à la disposition des utilisateurs. Mr U&D se réserve le droit de supprimer, sans mise en demeure préalable, tout contenu déposé dans cet espace qui contreviendrait à la législation applicable en France, en particulier aux dispositions relatives à la protection des données. Le cas échéant, Mr U&D se réserve également la possibilité de mettre en cause la responsabilité civile et/ou pénale de l’utilisateur, notamment en cas de message à caractère raciste, injurieux, diffamant, ou pornographique, quel que soit le support utilisé (texte, photographie…). 
7. Gestion des données personnelles. 
En France, les données personnelles sont notamment protégées par la loi n° 78-87 du 6 janvier 1978, la loi n° 2004-801 du 6 août 2004, l'article L. 226-13 du Code pénal et la Directive Européenne du 24 octobre 1995. 
A l'occasion de l'utilisation du site uetd.com , peuvent êtres recueillies : l'URL des liens par l'intermédiaire desquels l'utilisateur a accédé au site uetd.com , le fournisseur d'accès de l'utilisateur, l'adresse de protocole Internet (IP) de l'utilisateur. 
En tout état de cause Mr U&D ne collecte des informations personnelles relatives à l'utilisateur que pour le besoin de certains services proposés par le site uetd.com . L'utilisateur fournit ces informations en toute connaissance de cause, notamment lorsqu'il procède par lui-même à leur saisie. Il est alors précisé à l'utilisateur du site uetd.com l’obligation ou non de fournir ces informations. 
Conformément aux dispositions des articles 38 et suivants de la loi 78-17 du 6 janvier 1978 relative à l’informatique, aux fichiers et aux libertés, tout utilisateur dispose d’un droit d’accès, de rectification et d’opposition aux données personnelles le concernant, en effectuant sa demande écrite et signée, accompagnée d’une copie du titre d’identité avec signature du titulaire de la pièce, en précisant l’adresse à laquelle la réponse doit être envoyée. 
Aucune information personnelle de l'utilisateur du site uetd.com n'est publiée à l'insu de l'utilisateur, échangée, transférée, cédée ou vendue sur un support quelconque à des tiers. Seule l'hypothèse du rachat de Mr U&D et de ses droits permettrait la transmission des dites informations à l'éventuel acquéreur qui serait à son tour tenu de la même obligation de conservation et de modification des données vis à vis de l'utilisateur du site uetd.com . 
Le site n'est pas déclaré à la CNIL car il ne recueille pas d'informations personnelles. . 
Les bases de données sont protégées par les dispositions de la loi du 1er juillet 1998 transposant la directive 96/9 du 11 mars 1996 relative à la protection juridique des bases de données. 
8. Liens hypertextes et cookies. 
Le site uetd.com contient un certain nombre de liens hypertextes vers d’autres sites, mis en place avec l’autorisation de Mr U&D. Cependant, Mr U&D n’a pas la possibilité de vérifier le contenu des sites ainsi visités, et n’assumera en conséquence aucune responsabilité de ce fait. 
La navigation sur le site uetd.com est susceptible de provoquer l’installation de cookie(s) sur l’ordinateur de l’utilisateur. Un cookie est un fichier de petite taille, qui ne permet pas l’identification de l’utilisateur, mais qui enregistre des informations relatives à la navigation d’un ordinateur sur un site. Les données ainsi obtenues visent à faciliter la navigation ultérieure sur le site, et ont également vocation à permettre diverses mesures de fréquentation. 
Le refus d’installation d’un cookie peut entraîner l’impossibilité d’accéder à certains services. L’utilisateur peut toutefois configurer son ordinateur de la manière suivante, pour refuser l’installation des cookies : 
Sous Internet Explorer : onglet outil (pictogramme en forme de rouage en haut a droite) / options internet. Cliquez sur Confidentialité et choisissez Bloquer tous les cookies. Validez sur Ok. 
Sous Firefox : en haut de la fenêtre du navigateur, cliquez sur le bouton Firefox, puis aller dans l'onglet Options. Cliquer sur l'onglet Vie privée.
Paramétrez les Règles de conservation sur : utiliser les paramètres personnalisés pour l'historique. Enfin décochez-la pour désactiver les cookies. 
Sous Safari : Cliquez en haut à droite du navigateur sur le pictogramme de menu (symbolisé par un rouage). Sélectionnez Paramètres. Cliquez sur Afficher les paramètres avancés. Dans la section \"Confidentialité\", cliquez sur Paramètres de contenu. Dans la section \"Cookies\", vous pouvez bloquer les cookies. 
Sous Chrome : Cliquez en haut à droite du navigateur sur le pictogramme de menu (symbolisé par trois lignes horizontales). Sélectionnez Paramètres. Cliquez sur Afficher les paramètres avancés. Dans la section \"Confidentialité\", cliquez sur préférences. Dans l'onglet \"Confidentialité\", vous pouvez bloquer les cookies. 

9. Droit applicable et attribution de juridiction. 
Tout litige en relation avec l’utilisation du site uetd.com est soumis au droit français. Il est fait attribution exclusive de juridiction aux tribunaux compétents de Paris. 
10. Les principales lois concernées. 
Loi n° 78-17 du 6 janvier 1978, notamment modifiée par la loi n° 2004-801 du 6 août 2004 relative à l'informatique, aux fichiers et aux libertés. 
Loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique. 
11. Lexique. 
Utilisateur : Internaute se connectant, utilisant le site susnommé. 
Informations personnelles : « les informations qui permettent, sous quelque forme que ce soit, directement ou non, l'identification des personnes physiques auxquelles elles s'appliquent » (article 4 de la loi n° 78-17 du 6 janvier 1978).
", null]
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

    private function buildPartner()
    {
        return [
            ['BigMat', 'bigmat.png', 'http://www.bigmat.fr/', 'bigmat'],
            ['Point.P', 'pointp.png', 'http://www.pointp.fr/', 'point.p'],
            ['apas-btp', 'apas.png', 'http://www.apas.asso.fr/', 'apas'],
            ['SMA', 'sma.png', 'http://www.groupe-sma.fr/', 'sma'],
            ['Observatoire des métiers du BTP', 'ombtp.png','https://www.metiers-btp.fr/', 'ombtp'],
            ['Le Moniteur', 'moniteur.png' ,'http://www.lemoniteur.fr/', 'moniteur']
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
        $i = 1;
        foreach($contentBlocksData as $item) {
            $contentBlock = new ContentBlock();
            $contentBlock->setName($item)
                ->setPosition($i);
           $manager->persist($contentBlock);
           $manager->flush();
           foreach ($textBlocksData as $text) {
               if ($text[0] == $contentBlock->getPosition()) {
                   $textBlock = new TextBlock();
                   $textBlock->setName($text[1])
                       ->setTitle($text[2])
                       ->setContent($text[3])
                       ->setContentBlock($contentBlock)
                       ->setPosition($text[4]);
                   $manager->persist($textBlock);
               }
           }
           $i++;
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


        $partnersData = $this->buildPartner();
        $i = 1;
        foreach ($partnersData as $item) {
            $partner = new Partner();
            $partner->setRank($i)
                ->setName($item[0])
                ->setLogoName($item[1])
                ->setUrl($item[2])
                ->setAlt($item[3])
                ->setUpdatedAt(new \DateTime());
            $manager->persist($partner);
            $i++;
        }


        $contact = new Contact();
        $contact->setFirstname('Theo')
            ->setLastname('Bourgoin')
            ->setPhone('0617592918')
            ->setSubject('Sujet de test');
        $contact->setMessage('Je suis un message');
        $contact->setCallAt(new \DateTime());
        $contact->setEmail('bourgoi.theo@gmail.com');
        $manager->persist($contact);
        $answer = new Answer();
        $answer->setMessage('Je suis une reponse')
            ->setSubject('Sujet de test');
            $answer->setParent($contact);
        $contact->setAnswer($answer);
        $manager->persist($answer);


        $manager->flush();
    }




}