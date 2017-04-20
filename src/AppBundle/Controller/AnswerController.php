<?php


namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnswerController extends Controller
{
    /**
     * @Route("admin/answer/", name="answer_index")
     */
    public function indexAction()
    {
        $answers = $this->getDoctrine()->getManager()->getRepository('AppBundle:Answer')->findAll();
        return $this->render('admin/answer/index.html.twig', [
            'answers' => $answers
        ]);
    }

}