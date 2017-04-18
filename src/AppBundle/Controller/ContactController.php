<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Contact controller.
 *
 */
class ContactController extends Controller
{
    /**
     * Lists all contact entities.
     *
     * @Route("admin/contact", name="contact_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contacts = $em->getRepository('AppBundle:Contact')->findAll();

        return $this->render('admin/contact/index.html.twig', array(
            'contacts' => $contacts,
        ));
    }

    /**
     * Creates a new contact entity.
     * @Route("contact/new", name="contact_new")
     * @param Request $request
     * @Method({"GET", "POST"})
     * @return Response
     */
    public function newAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact, array(
            'action' => $this->generateUrl('contact_new'))
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('front/contact/new.html.twig', array(
            'contact' => $contact,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a contact entity.
     *
     * @Route("admin/contact/{id}", name="contact_show")
     * @param Contact $contact
     * @return Response
     * @Method("GET")
     */
    public function showAction(Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact);

        return $this->render('admin/contact/show.html.twig', array(
            'contact' => $contact,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a contact entity.
     *
     * @Route("admin/contact/{id}", name="contact_delete")
     * @param Request $request
     * @param Contact $contact
     * @Method("DELETE")
     * @return Response
     */
    public function deleteAction(Request $request, Contact $contact)
    {
        $form = $this->createDeleteForm($contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contact);
            $em->flush();
        }

        return $this->redirectToRoute('contact_index');
    }

    /**
     * Creates a form to delete a contact entity.
     *
     * @param Contact $contact The contact entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contact $contact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contact_delete', array('id' => $contact->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
