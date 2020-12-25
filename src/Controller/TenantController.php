<?php

namespace App\Controller;

use App\Entity\Tenant;
use App\Form\TenantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/locataire", name="tenant_")
 */
class TenantController extends AbstractController
{
    /**
     * @Route ("/new", name="new")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $tenant = new Tenant();
        $form = $this->createForm(TenantType::class, $tenant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($tenant);
            $em->flush();
            return $this->redirectToRoute('home_index');
        }
        return $this->render('tenant/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tenant", name="tenant")
     */
    public function index(): Response
    {
        return $this->render('tenant/show.html.twig', [
            'controller_name' => 'TenantController',
        ]);
    }
}
