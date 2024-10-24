<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evenement;
use Doctrine\ORM\EntityManagerInterface;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $evenements = $entityManager->getRepository(Evenement::class)->findAll();
    
        // Arrays to hold our data
        $dates = [];
        $availableTickets = [];
        $soldTickets = []; // This should be defined based on your application logic
    
        foreach ($evenements as $event) {
            $dates[] = $event->getDatedebutevent();
            $availableTickets[] = $event->getNbrticketdispo();
            // Assume you have a method to calculate sold tickets. If not, you might need to add that logic.
            $soldTickets[] = $event->getCapaciteevent() - $event->getNbrticketdispo(); // Example logic for sold tickets
        }
    
        return $this->render('admin/index.html.twig', [
            'dates' => json_encode($dates),
            'availableTickets' => json_encode($availableTickets),
            'soldTickets' => json_encode($soldTickets),
        ]);
    }
    
}
