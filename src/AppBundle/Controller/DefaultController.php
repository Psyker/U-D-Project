<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $partners = $em->getRepository('AppBundle:Partner')->findAll();
        $contentBlocks = $em->getRepository('AppBundle:ContentBlock')->findBy([], ['id' => 'ASC']);
        return $this->render('front/default/index.html.twig', [
            'partners' => $partners,
            'contentBlocks' => $contentBlocks
        ]);
    }
}
