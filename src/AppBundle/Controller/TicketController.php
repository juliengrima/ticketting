<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ticket;
use AdminBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ticket controller.
 *
 */
class TicketController extends Controller
{
    /**
     * Lists ticket entities untreated.
     *
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $tickets = $em->getRepository('AppBundle:Ticket')->findBy( array('treated' => null) );

        if ($tickets != null) {
            $userId = $tickets[0]->getUserId();
            $user = $em->getRepository('AdminBundle:User')->findById($userId);

            return $this->render('ticket/index.html.twig', array(
                'tickets' => $tickets,
                'userid' => $user,

            ));
        }

        return $this->render('ticket/index.html.twig');
    }

    /**
     * Lists ticket entities treated.
     *
     */
    public function treatedAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tickets = $em->getRepository('AppBundle:Ticket')->findBy( array('treated' => 1) );

        if ($tickets != null) {
            $userId = $tickets[0]->getUserId();
            $user = $em->getRepository('AdminBundle:User')->findById($userId);

            return $this->render('ticket/index.html.twig', array(
                'tickets' => $tickets,
                'userid' => $user,

            ));
        }

        return $this->render('ticket/index.html.twig');
    }

    /**
     * Creates a new ticket entity.
     *
     */
    public function newAction(Request $request)
    {
        $ticket = new Ticket();
        $form = $this->createForm('AppBundle\Form\TicketType', $ticket);
        $form->handleRequest($request);

        $userId = $this->getUser()->getId();

        if ($form->isSubmitted() && $form->isValid()) {

            $ticket->setUserId($userId);

            $em = $this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->flush();

            return $this->redirectToRoute('ticket_show', array('id' => $ticket->getId()));
        }

        return $this->render('ticket/new.html.twig', array(
            'ticket' => $ticket,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ticket entity.
     *
     */
    public function showAction(Ticket $ticket)
    {
        $deleteForm = $this->createDeleteForm($ticket);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AdminBundle:User')->findBy( array('id' => $ticket->getUserId()) );

        return $this->render('ticket/show.html.twig', array(
            'ticket' => $ticket,
            'userid' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ticket entity.
     *
     */
    public function editAction(Request $request, Ticket $ticket)
    {
        $deleteForm = $this->createDeleteForm($ticket);
        $editForm = $this->createForm('AppBundle\Form\TicketEditType', $ticket);
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AdminBundle:User')->findBy( array('id' => $ticket->getUserId()) );

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ticket_index', array('id' => $ticket->getId()));
        }

        return $this->render('ticket/edit.html.twig', array(
            'tickets' => $ticket,
            'userid' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ticket entity.
     *
     */
    public function deleteAction(Request $request, Ticket $ticket)
    {
        $form = $this->createDeleteForm($ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ticket);
            $em->flush();
        }

        return $this->redirectToRoute('ticket_index');
    }

    /**
     * Creates a form to delete a ticket entity.
     *
     * @param Ticket $ticket The ticket entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ticket $ticket)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ticket_delete', array('id' => $ticket->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
