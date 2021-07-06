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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Backend: Administrateur controller.
 * @Route("/Administrateur", name="backend_administrateur")
 * @IsGranted("ROLE_ADMIN")
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
    public function addAction(Request $request,UserPasswordEncoderInterface $encodert)
    {

        $Administrateur = new Administrateur();
        $form = $this->createForm(AdministrateurType::class, $Administrateur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newEncodedPassword = $encodert->encodePassword($Administrateur, $Administrateur->getPassword());
            $Administrateur->setPassword($newEncodedPassword);
            $roles[]='ROLE_ADMIN';
            $Administrateur->setRoles($roles);

             $Administrateur = $this->AdministrateurService->persist($Administrateur);

             $request->getSession()->getFlashBag()->add('success', 'ajout avec succée !');
             return $this->redirectToRoute('backend_administrateur_liste');
        }

        return $this->render('Administrateur/form.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/edit/{administrateur}", name="_edit")
     
     */
    public function editAction(Request $request, Administrateur $administrateur)
    {

        $form = $this->createForm(AdministrateurType::class, $administrateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $administrateur = $this->AdministrateurService->persist($administrateur);
             $request->getSession()->getFlashBag()->add('success', 'modification avec succée !');
             return $this->redirectToRoute('backend_administrateur_liste');
        }

        return $this->render('Administrateur/form.html.twig', array('form' => $form->createView(),'ligne' => $administrateur));
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
