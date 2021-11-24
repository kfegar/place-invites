<?php

namespace App\Controller;

use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        $now = new \DateTime();
        $em = $this->getDoctrine()->getManager();
        $reservationRepository = $em->getRepository(Reservation::class);
        $reservations = $reservationRepository->findByNotPassed($now->format('Y-m-d'));
        return $this->render('index.html.twig', [
            'reservations' => $reservations,
        ]);
    }
}
