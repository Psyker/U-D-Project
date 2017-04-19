<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class QuotesController
 * @package AppBundle\Controller
 */
class QuotesController extends Controller
{

    /**
     * @Route("admin/quotes", name="quotes_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $quotes = $em->getRepository('AppBundle:Quotes')->findAll();
        return $this->render('admin/quotes/index.html.twig', [
            'quotes' => $quotes
        ]);
    }
}