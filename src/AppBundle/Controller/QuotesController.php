<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Quotes;
use AppBundle\Form\QuotesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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

    /**
     * @Route("admin/quotes/new", name="new_quotes")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $quote = new Quotes();
        $form = $this->createForm(QuotesType::class, $quote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($quote);
            $em->flush();
            $this->addFlash('success', 'La citation a bien été crée.');
            return $this->redirectToRoute('quotes_index');
        }

        return $this->render('admin/quotes/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/quotes/edit/{id}", name="edit_quotes")
     * @param Request $request
     * @param Quotes $quotes
     * @return Response
     */
    public function editAction(Request $request, Quotes $quotes)
    {
        $form = $this->createForm(QuotesType::class, $quotes);
        $form->handleRequest($request);
        $deleteForm = $this->createDeleteForm($quotes);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'La citation a bien été éditée.');
            return $this->redirectToRoute('quotes_index');
        }

        return $this->render('admin/quotes/edit.html.twig', [
            'quotes' => $quotes,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView()
        ]);
    }

    /**
     * Deletes a quote entity.
     *
     * @Route("admin/quotes/delete/{id}", name="delete_quotes")
     * @param Request $request
     * @param Quotes $quote
     * @Method("DELETE")
     * @return Response
     */
    public function deleteAction(Request $request, Quotes $quote)
    {
        $form = $this->createDeleteForm($quote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($quote);
            $em->flush();
            $this->addFlash('success', 'La citation a bien été supprimée.');
        }

        return $this->redirectToRoute('quotes_index');
    }

    /**
     * Creates a form to delete a quotes entity.
     *
     * @param Quotes $quote The quotes entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Quotes $quote)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_quotes', array('id' => $quote->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}