<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Partner;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Partner controller.
 *
 * @Route("partner")
 */
class PartnerController extends Controller
{
    /**
     * Lists all partner entities.
     *
     * @Route("/", name="partner_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partners = $em->getRepository('AppBundle:Partner')->findAll();

        return $this->render('admin/partner/index.html.twig', array(
            'partners' => $partners,
        ));
    }

    /**
     * Creates a new partner entity.
     *
     * @Route("/new", name="partner_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $partner = new Partner();
        $form = $this->createForm('AppBundle\Form\PartnerType', $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partner);
            $em->flush();

            return $this->redirectToRoute('partner_show', array('id' => $partner->getId()));
        }

        return $this->render('admin/partner/new.html.twig', array(
            'partner' => $partner,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a partner entity.
     *
     * @Route("/{id}", name="partner_show")
     * @Method("GET")
     */
    public function showAction(Partner $partner)
    {
        $deleteForm = $this->createDeleteForm($partner);

        return $this->render('admin/partner/show.html.twig', array(
            'partner' => $partner,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing partner entity.
     *
     * @Route("/{id}/edit", name="partner_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Partner $partner)
    {
        $deleteForm = $this->createDeleteForm($partner);
        $editForm = $this->createForm('AppBundle\Form\PartnerType', $partner);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partner_edit', array('id' => $partner->getId()));
        }

        return $this->render('admin/partner/edit.html.twig', array(
            'partner' => $partner,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a partner entity.
     *
     * @Route("/{id}", name="partner_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Partner $partner)
    {
        $form = $this->createDeleteForm($partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partner);
            $em->flush();
        }

        return $this->redirectToRoute('partner_index');
    }

    /**
     * Creates a form to delete a partner entity.
     *
     * @param Partner $partner The partner entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Partner $partner)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('partner_delete', array('id' => $partner->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
