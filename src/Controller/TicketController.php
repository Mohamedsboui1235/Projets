<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\Evenement;
use App\Form\TicketType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ticket')]
class TicketController extends AbstractController
{
    #[Route('/', name: 'app_ticket_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $tickets = $entityManager
            ->getRepository(Ticket::class)
            ->findAll();

        return $this->render('ticket/index.html.twig', [
            'tickets' => $tickets,
        ]);
    }

    #[Route('/{idevent}/new', name: 'app_ticket_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Evenement $evenement): Response
    {
        $ticket = new Ticket();
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $nbreTicketChoisi = $ticket->getNbrTicket();
            $nbreTicketDispo = $evenement->getNbrticketdispo();
    
            if ($nbreTicketChoisi > $nbreTicketDispo) {
                return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
            }
    
            // Set the event-related properties directly from the Evenement entity
            $ticket->setNomevent($evenement->getNomevent()); // Set event name
            $ticket->setPrixticket($evenement->getPrixentre()); // Set ticket price
            $ticket->setEvent($evenement); // Set the event object for the ticket
    
            // Update available ticket count
            $evenement->setNbrticketdispo($nbreTicketDispo - $nbreTicketChoisi);
    
            $entityManager->persist($ticket);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_ticket_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('ticket/new.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
            'evenement' => $evenement
        ]);
    }
     

    #[Route('/{idticket}', name: 'app_ticket_show', methods: ['GET'])]
    public function show(Ticket $ticket): Response
    {
        return $this->render('ticket/show.html.twig', [
            'ticket' => $ticket,
        ]);
    }

    #[Route('/{idticket}/edit', name: 'app_ticket_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ticket $ticket, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ticket_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ticket/edit.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    #[Route('/{idticket}', name: 'app_ticket_delete', methods: ['POST'])]
    public function delete(Request $request, Ticket $ticket, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ticket->getIdticket(), $request->request->get('_token'))) {
            $entityManager->remove($ticket);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ticket_index', [], Response::HTTP_SEE_OTHER);
    }
}
