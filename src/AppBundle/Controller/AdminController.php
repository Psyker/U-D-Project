<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class AdminController
 * @package AppBundle\Controller
 * @Route("admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $messageCount = $em->getRepository('AppBundle:Contact')->countInboxMessages();
        $countPhoneBack = $em->getRepository('AppBundle:Contact')->countPhoneBack();
        return $this->render('admin/default/index.html.twig', [
            'messageCount' => $messageCount,
            'phoneBackCount' => $countPhoneBack
        ]);
    }

}