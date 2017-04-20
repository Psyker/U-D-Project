<?php

namespace AppBundle\Controller;


use AppBundle\Entity\ContentBlock;
use AppBundle\Form\ContentBlockType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ContentBlockController extends Controller
{
    /**
     * Lists all contact entities.
     *
     * @Route("admin/contentblock/{id}", name="content_block_show")
     * @param ContentBlock $contentBlock
     * @param Request $request
     * @return Response
     */
    public function showAction(Request $request, ContentBlock $contentBlock)
    {
        $em = $this->getDoctrine()->getManager();

        $textblocks = $em->getRepository('AppBundle:TextBlock')->getTextBlockByContentBlock($contentBlock->getId());
        $form = $this->createForm(ContentBlockType::class, $contentBlock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('content_block_show', array('id' => $contentBlock->getId()));
        }

        return $this->render('admin/contentblock/show.html.twig', array(
            'form' => $form->createView(),
            'contentblock' => $contentBlock,
            'textblocks' => $textblocks
        ));
    }
}