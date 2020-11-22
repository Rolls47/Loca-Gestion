<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\LocationType;
use App\Form\PropertyType;
use App\Repository\PropertyAccountingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/propriete", name="property_")
 */
class PropertyController extends AbstractController
{
    /**
     * @Route ("/new", name="new")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($property);
            $em->flush();
            return $this->redirectToRoute('home_index');
        }
        return $this->render('property/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="accounting")
     * @param Property $property
     * @param PropertyAccountingRepository $propertyAccountingRepository
     * @return Response
     */
    public function show(Property $property, PropertyAccountingRepository $propertyAccountingRepository): Response
    {
        $propertiesAccounting = $propertyAccountingRepository->findBy(['property' => $property]);

        return $this->render('property/show.html.twig', [
            'propertiesAccounting' => $propertiesAccounting,
        ]);
    }
}
