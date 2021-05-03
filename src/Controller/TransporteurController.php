<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\String\Slugger\AsciiSlugger;
use App\Form\TransporteurType;
use App\Entity\Transporteur;
use App\Services\TransporteurService;

/**
 * Backend: Transporteur controller.
 * @Route("/transporteur", name="backend_Transporteur")
*/
class TransporteurController extends AbstractController
{


    public function __construct(TransporteurService $TransporteurService)
    {
        $this->TransporteurService = $TransporteurService;
    }


    /**
     * @Route("/add", name="_add")
     */
    public function addAction(Request $request)
    {

        $Transporteur = new Transporteur();
        $form = $this->createForm(TransporteurType::class, $Transporteur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $Transporteur = $this->TransporteurService->persist($Transporteur);

             $request->getSession()->getFlashBag()->add('success', 'ajout avec succée !');
             return $this->redirectToRoute('backend_transporteur_liste');
        }

        return $this->render('transporteur/form.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/edit/{id}", name="_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function editAction(Request $request, Transporteur $Transporteur)
    {

        $form = $this->createForm(TransporteurType::class, $Transporteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $Transporteur = $this->TransporteurService->persist($Transporteur);
             $request->getSession()->getFlashBag()->add('success', 'modification avec succée !');
             return $this->redirectToRoute('backend_transporteur_liste');
        }

        return $this->render('Transporteur/form.html.twig', array('form' => $form->createView(),'ligne' => $Poste));
    }


    /**
     * @Route("/liste", name="_liste")
     */
    public function getTransporteur()
    {
        $liste = $this->TransporteurService->getPoste();
        return $this->render('Transporteur/liste.html.twig', ['liste' => $liste]);
    }

    /**
     * @Route("/delete/{id}", name="_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteAction(Transporteur $Transporteur, Request $request)
    {
            try {
            $this->TransporteurService->remove($Transporteur);
            $request->getSession()->getFlashBag()->add('success', 'Transporteur supprimée avec succès !');
        } catch (\Exception $exception) {
             $request->getSession()->getFlashBag()->add('danger', 'un ou plusieurs produit liés  à cette entité   !');
        }


  
        return $this->redirectToRoute('backend_transporteur_liste');
    }
}
