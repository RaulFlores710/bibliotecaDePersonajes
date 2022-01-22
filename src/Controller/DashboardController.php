<?php

namespace App\Controller;

use App\Entity\Personaje;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class DashboardController extends AbstractController
{
    public function index(ManagerRegistry $doctrine): Response
    {
        $em=$doctrine->getManager();
        $personajes=$em->getRepository(Personaje::class)->findAll();
        return $this->render('dashboard/index.html.twig', [
            'personajes' => $personajes,
        ]);
    }
}
