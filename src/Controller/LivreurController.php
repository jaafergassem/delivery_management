<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\String\Slugger\AsciiSlugger;
use App\Form\LivreurType;
use App\Entity\Livreur;
use App\Services\LivreurService;

/**
 * Backend: Livreur controller.
 * @Route("/livreur", name="backend_livreur")
*/
class LivreurController extends AbstractController
{


    public function __construct(LivreurService $LivreurService)
    {
        $this->LivreurService = $LivreurService;
    }


    /**
     * @Route("/add", name="_add")
     */
    public function addAction(Request $request)
    {

        $Livreur = new Livreur();
        $form = $this->createForm(LivreurType::class, $Livreur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $Livreur = $this->LivreurService->persist($Livreur);

             $request->getSession()->getFlashBag()->add('success', 'ajout avec succée !');
             return $this->redirectToRoute('backend_livreur_liste');
        }

        return $this->render('Livreur/form.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/edit/{id}", name="_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function editAction(Request $request, Livreur $Livreur)
    {

        $form = $this->createForm(LivreurType::class, $Livreur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $Livreur = $this->LivreurService->persist($Livreur);
             $request->getSession()->getFlashBag()->add('success', 'modification avec succée !');
             return $this->redirectToRoute('backend_livreur_liste');
        }

        return $this->render('Livreur/form.html.twig', array('form' => $form->createView(),'ligne' => $Poste));
    }


    /**
     * @Route("/liste", name="_liste")
     */
    public function getLivreur()
    {
        $liste = $this->LivreurService->getLivreur();
        return $this->render('Livreur/liste.html.twig', ['liste' => $liste]);
    }

    /**
     * @Route("/delete/{id}", name="_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteAction(Livreur $Livreur, Request $request)
    {
            try {
            $this->LivreurService->remove($Livreur);
            $request->getSession()->getFlashBag()->add('success', 'Livreur supprimée avec succès !');
        } catch (\Exception $exception) {
             $request->getSession()->getFlashBag()->add('danger', 'un ou plusieurs produit liés  à cette entité   !');
        }


  
        return $this->redirectToRoute('backend_livreur_liste');
    }
}
