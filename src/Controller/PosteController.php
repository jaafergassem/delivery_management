<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\String\Slugger\AsciiSlugger;
use App\Form\PosteType;
use App\Entity\Poste;
use App\Services\PosteService;

/**
 * Backend: Poste controller.
 * @Route("/poste", name="backend_poste")
*/
class PosteController extends AbstractController
{


    public function __construct(PosteService $PosteService)
    {
        $this->PosteService = $PosteService;
    }


    /**
     * @Route("/add", name="_add")
     */
    public function addAction(Request $request)
    {

        $Poste = new Poste();
        $form = $this->createForm(PosteType::class, $Poste);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $Poste = $this->PosteService->persist($Poste);

             $request->getSession()->getFlashBag()->add('success', 'ajout avec succée !');
             return $this->redirectToRoute('backend_poste_liste');
        }

        return $this->render('Poste/form.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/edit/{id}", name="_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function editAction(Request $request, Poste $Poste)
    {

        $form = $this->createForm(PosteType::class, $Poste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $Poste = $this->PosteService->persist($Poste);
             $request->getSession()->getFlashBag()->add('success', 'modification avec succée !');
             return $this->redirectToRoute('backend_poste_liste');
        }

        return $this->render('Poste/form.html.twig', array('form' => $form->createView(),'ligne' => $Poste));
    }


    /**
     * @Route("/liste", name="_liste")
     */
    public function getPoste()
    {
        $liste = $this->PosteService->getPoste();
        return $this->render('Poste/liste.html.twig', ['liste' => $liste]);
       

    }

    /**
     * @Route("/delete/{id}", name="_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteAction(Poste $Poste, Request $request)
    {
            try {
            $this->PosteService->remove($Poste);
            $request->getSession()->getFlashBag()->add('success', 'Poste supprimée avec succès !');
        } catch (\Exception $exception) {
             $request->getSession()->getFlashBag()->add('danger', 'un ou plusieurs produit liés  à cette entité   !');
        }


  
        return $this->redirectToRoute('backend_poste_liste');
    }
}
