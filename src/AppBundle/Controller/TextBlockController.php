<?php

namespace AppBundle\Controller;


use AppBundle\Entity\TextBlock;
use AppBundle\Form\TextBlockType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TextBlockController extends Controller
{
    /**
     * Finds and displays a textBlock entity.
     *
     * @Route("admin/textblock/{id}", name="text_block_show")
     * @param TextBlock $textBlock
     * @param Request $request
     * @return Response
     */
    public function showAction(Request $request, TextBlock $textBlock)
    {
        $deleteForm = $this->createDeleteForm($textBlock);

        $form = $this->createForm(TextBlockType::class, $textBlock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Le bloc de texte a bien été édité.');
            return $this->redirectToRoute('content_block_show', [
                'id' => $textBlock->getContentBlock()->getId()
            ]);
        }

        return $this->render('admin/textblock/show.html.twig', array(
            'textblock' => $textBlock,
            'delete_form' => $deleteForm->createView(),
            'form' => $form->createView()
        ));
    }

    /**
     * Deletes a contact entity.
     *
     * @Route("admin/textblock/{id}", name="text_block_delete")
     * @param Request $request
     * @param TextBlock $textBlock
     * @Method("DELETE")
     * @return Response
     */
    public function deleteAction(Request $request, TextBlock $textBlock)
    {
        $form = $this->createDeleteForm($textBlock);
        $form->handleRequest($request);
        $redirectId = $textBlock->getContentBlock()->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($textBlock);
            $em->flush();
            $this->addFlash('success', 'Le bloc de texte a bien été supprimé.');
        }

        return $this->redirectToRoute('content_block_show', [
            'id' => $redirectId
        ]);
    }

    /**
     * Creates a form to delete a textBlock entity.
     *
     * @param TextBlock $textBlock The contact entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TextBlock $textBlock)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('text_block_delete', array('id' => $textBlock->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}