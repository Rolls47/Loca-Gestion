<?php

namespace App\Controller;

use App\Entity\Location;
use App\Entity\LocationAccounting;
use App\Repository\LocationAccountingRepository;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/", name="home")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function index(EntityManagerInterface $em): Response
    {
        $locationAccounting = $em->getRepository('App:LocationAccounting');
        $totalLocationAccounting = ($locationAccounting->totalLocationAccounting()[1] / 100);

        $propertyAccounting = $em->getRepository('App:PropertyAccounting');
        $totalPropertyAccounting =($propertyAccounting->totalPropertyAccounting()[1] / 100);



        return $this->render('home/index.html.twig', [
            'sumLocalAccounting' => $totalLocationAccounting,
            'sumPropertyAccounting' => $totalPropertyAccounting,
        ]);
    }
}
