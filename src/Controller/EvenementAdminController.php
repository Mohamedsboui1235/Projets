<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Ticket;
use App\Form\EvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/evenement')]
class EvenementAdminController extends AbstractController
{

    #[Route('/', name: 'admin_evenement_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        // Get sort parameters with defaults
        $sortField = $request->query->get('sortField', 'nbrticketdispo');
        $sortOrder = $request->query->get('sortOrder', 'asc');
    
        $orderBy = $sortOrder === 'desc' ? 'DESC' : 'ASC';
    
        // Find events sorted by the specified field
        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findBy([], [$sortField => $orderBy]);
    
        return $this->render('evenementAdmin/index.html.twig', [
            'evenements' => $evenements,
            'currentSortField' => $sortField,
            'currentSortOrder' => $sortOrder,
        ]);
    }      
    
    #[Route('/new', name: 'admin_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $request->files->get('evenement')['image'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $uploads_directory,
                $filename
            );
            $evenement->setImage($filename);
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('admin_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenementAdmin/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{idevent}', name: 'admin_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenementAdmin/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('/{idevent}/edit', name: 'admin_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $request->files->get('evenement')['image'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $uploads_directory,
                $filename
            );
            $evenement->setImage($filename);
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('admin_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenementAdmin/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{idevent}', name: 'admin_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getIdevent(), $request->request->get('_token'))) {
            // Fetch all related tickets
            $tickets = $entityManager->getRepository(Ticket::class)->findBy(['event' => $evenement]);
            
            // Remove each ticket
            foreach ($tickets as $ticket) {
                $entityManager->remove($ticket);
            }
    
            // Now remove the event
            $entityManager->remove($evenement);
            $entityManager->flush();
        }
    
        return $this->redirectToRoute('admin_evenement_index', [], Response::HTTP_SEE_OTHER);
    }
    
    
}
