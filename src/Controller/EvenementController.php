<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Entity\Ticket;
use App\Form\TicketType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/evenement')]
class EvenementController extends AbstractController
{
    #[Route('/', name: 'app_evenement_index', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $evenements = $entityManager
->getRepository(Evenement::class)
->findAll();

$ticket = new Ticket();
$form = $this->createForm(TicketType::class, $ticket);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
// $ticketId = $ticket->getIdticket();
$entityManager->persist($ticket);
$entityManager->flush();

return $this->redirectToRoute('app_ticket_show', ['idticket' => $ticket->getIdticket()], Response::HTTP_SEE_OTHER);
}

return $this->renderForm('evenement/index.html.twig', [
'form' => $form,
'evenements' => $evenements,
'ticket' => $ticket,
]);
    }

    #[Route('/{idevent}', name: 'app_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }
}







// $evenements = $entityManager
// ->getRepository(Evenement::class)
// ->findAll();

// $ticket = new Ticket();
// $form = $this->createForm(TicketType::class, $ticket);
// $form->handleRequest($request);

// if ($form->isSubmitted() && $form->isValid()) {
// // $ticketId = $ticket->getIdticket();
// $entityManager->persist($ticket);
// $entityManager->flush();

// return $this->redirectToRoute('app_ticket_show', ['idticket' => $ticket->getIdticket()], Response::HTTP_SEE_OTHER);
// }

// return $this->renderForm('evenement/index.html.twig', [
// 'form' => $form,
// 'evenements' => $evenements,
// 'ticket' => $ticket,
// ]);