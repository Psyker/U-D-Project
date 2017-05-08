<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Answer;
use AppBundle\Entity\Contact;
use AppBundle\Form\AnswerType;
use AppBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @Route("admin/contact/inbox", name="contact_inbox_index")
     * @return Response
     */
    public function inboxAction()
    {
        $em = $this->getDoctrine()->getManager();
        $contacts = $em->getRepository('AppBundle:Contact')->findAll();
        return $this->render('admin/contact/inbox.html.twig', [
            'contacts' => $contacts
        ]);
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
            $this->addFlash('success', 'Votre message a bien été envoyé.');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('front/contact/new.html.twig', array(
            'contact' => $contact,
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a contact entity.
     *
     * @Route("admin/contact/{id}/delete", name="contact_delete")
     * @param Contact $contact
     * @return Response
     */
    public function deleteAction(Contact $contact)
    {

        $em = $this->getDoctrine()->getManager();
        $answer = $contact->getAnswer();
        $em->remove($answer);
        $em->remove($contact);
        $em->flush();

        return $this->redirectToRoute('contact_index');
    }


    /**
     * @Route("admin/contact/{id}/called", name="contact_called")
     * @param Contact $contact
     * @return RedirectResponse
     */
    public function calledAction(Contact $contact)
    {
        $em = $this->getDoctrine()->getManager();
        $contact = $em->getRepository('AppBundle:Contact')->find($contact->getId());
        if (!empty($contact)) {
            $contact->setCalled(true);
            $em->flush();
            $this->addFlash('success', 'Le contact a bien été appelé.');
            return $this->redirectToRoute('contact_index');
        }
        $this->addFlash('success', 'Ce contact n\'existe pas');
        return $this->redirectToRoute('contact_index');

    }

    /**
     * @Route("admin/contact/{id}/answer", name="contact_answer")
     * @param Request $request
     * @param Contact $contact
     * @return Response
     */
    public function answerAction(Request $request, Contact $contact)
    {
        $em = $this->getDoctrine()->getManager();
        $answer = new Answer();
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $answer->setParent($contact);
            $contact->setAnswer($answer);
            $em->persist($answer);
            $message = \Swift_Message::newInstance()
                ->setSubject($answer->getSubject())
                ->setFrom("bourgoi.theo@gmail.com")
                ->setTo($contact->getEmail())
                ->setBody($answer->getMessage(),'text/html');
            $this->get('mailer')->send($message);
            $em->flush();
            $this->addFlash('success', 'Votre réponse a bien été envoyé.');
            return $this->redirectToRoute('contact_index');
        }

        return $this->render('admin/contact/answer.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
