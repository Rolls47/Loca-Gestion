<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertyAccounting;
use App\Form\PropertyAccountingType;
use Doctrine\ORM\EntityManagerInterface;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Column\DateTimeColumn;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/compta", name="propertyAccounting_")
 **/
class PropertyAccountingController extends AbstractController
{
    /**
     * @Route ("/new", name="new")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $propertyAccounting = new PropertyAccounting();
        $form = $this->createForm(PropertyAccountingType::class, $propertyAccounting);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($propertyAccounting);
            $em->flush();
            return $this->redirectToRoute('home_index');
        }
        return $this->render('property_accounting/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="show")
     * @param Property $property
     * @param Request $request
     * @param DataTableFactory $dataTableFactory
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function show(EntityManagerInterface $em, Property $property, Request $request, DataTableFactory $dataTableFactory): Response
    {
        $properties =  $em->getRepository('App:PropertyAccounting')->findBy(['property' => $property]);

        $propertiesAccounting = $em->getRepository('App:PropertyAccounting')->findBy(
            ['property' => $property],
            ['date' => 'ASC']
        );

        foreach ($properties as $data){
            $propriete = $data->getProperty()->getName();
        }

        $results = [];
        foreach ($propertiesAccounting as $propertyAccounting) {
            $results[] = [
                'id' => $propertyAccounting->getId(),
                'label' => $propertyAccounting->getLabel(),
                'operationType' => $propertyAccounting->getOperationType(),
                'value' => ($propertyAccounting->getValue() / 100),
                'date' => $propertyAccounting->getDate(),
                'comment' => $propertyAccounting->getComment(),
                'property' => $propertyAccounting->getProperty(),
            ];
        }

        $datatable = $dataTableFactory->create()
            ->add('id', TextColumn::class, [
                'label' => 'id.'
            ])
            ->add('label', TextColumn::class, [
                'label' => 'label',
                'orderable' => true
            ])
            ->add('operationType', TextColumn::class, [
                'label' => 'Type d\'opération',
                'orderable' => true
            ])
            ->add('value', TextColumn::class, [
                'label' => 'Montant',
                'orderable' => true
            ])
            ->add('date', DateTimeColumn::class, [
                'format' => 'd-m-Y',
                'label' => 'Date',
                'orderable' => true
            ])
            ->add('comment', TextColumn::class, [
                'label' => 'Commentaire',
            ])
            ->add('property', TextColumn::class, [
                'label' => 'Propriétée',
                'orderable' => true
            ]);

        $datatable->createAdapter(ArrayAdapter::class, $results);
        $datatable->handleRequest($request);

        if ($datatable->isCallback()) {
            return $datatable->getResponse();
        }

        return $this->render('property_accounting/show.html.twig', [
            'datatable' => $datatable,
            'property' => $propriete,
        ]);
    }
}
