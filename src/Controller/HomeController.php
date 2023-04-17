<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
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
        /** @var ReservationRepository $reservationRepository */
        $reservationRepository = $this->getDoctrine()->getManager()->getRepository(Reservation::class);
        $reservations = $reservationRepository->findByNotPassed($now->format('Y-m-d'));
        return $this->render('index.html.twig', [
            'reservations' => $reservations,
        ]);
    }
}
