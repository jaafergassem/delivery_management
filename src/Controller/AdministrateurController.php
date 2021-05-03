<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\String\Slugger\AsciiSlugger;
use App\Form\AdministrateurType;
use App\Entity\Administrateur;
use App\Services\AdministrateurService;

/**
 * Backend: Administrateur controller.
 * @Route("/Administrateur", name="backend_administrateur")
*/
class AdministrateurController extends AbstractController
{


    public function __construct(AdministrateurService $AdministrateurService)
    {
        $this->AdministrateurService = $AdministrateurService;
    }


    /**
     * @Route("/add", name="_add")
     */
    public function addAction(Request $request)
    {

        $Administrateur = new Administrateur();
        $form = $this->createForm(AdministrateurType::class, $Administrateur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $Administrateur = $this->AdministrateurService->persist($Administrateur);

             $request->getSession()->getFlashBag()->add('success', 'ajout avec succée !');
             return $this->redirectToRoute('backend_administrateur_liste');
        }

        return $this->render('Administrateur/form.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/edit/{id}", name="_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function editAction(Request $request, Administrateur $Administrateur)
    {

        $form = $this->createForm(AdministrateurType::class, $Administrateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $Administrateur = $this->AdministrateurService->persist($Administrateur);
             $request->getSession()->getFlashBag()->add('success', 'modification avec succée !');
             return $this->redirectToRoute('backend_administrateur_liste');
        }

        return $this->render('Administrateur/form.html.twig', array('form' => $form->createView(),'ligne' => $Administrateur));
    }


    /**
     * @Route("/liste", name="_liste")
     */
    public function getAdministrateur()
    {
        $liste = $this->AdministrateurService->getAdministrateur();
        return $this->render('Administrateur/liste.html.twig', ['liste' => $liste]);
    }

    /**
     * @Route("/delete/{id}", name="_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteAction(Administrateur $Administrateur, Request $request)
    {
            try {
            $this->AdministrateurService->remove($Administrateur);
            $request->getSession()->getFlashBag()->add('success', 'Administrateur supprimée avec succès !');
        } catch (\Exception $exception) {
             $request->getSession()->getFlashBag()->add('danger', 'un ou plusieurs produit liés  à cette entité   !');
        }


  
        return $this->redirectToRoute('backend_administrateur_liste');
    }
}
