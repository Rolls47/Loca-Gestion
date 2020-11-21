<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyAccountingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/propriete", name="property_")
 */
class PropertyController extends AbstractController
{
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
