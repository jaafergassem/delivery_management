<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\String\Slugger\AsciiSlugger;
use App\Form\CamionType;
use App\Entity\Camion;
use App\Services\CamionService;

/**
 * Backend: Camion controller.
 * @Route("/camion", name="backend_camion")
*/
class CamionController extends AbstractController
{


    public function __construct(CamionService $CamionService)
    {
        $this->CamionService = $CamionService;
    }


    /**
     * @Route("/add", name="_add")
     */
    public function addAction(Request $request)
    {

        $Camion = new Camion();
        $form = $this->createForm(CamionType::class, $Camion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $Camion = $this->CamionService->persist($Camion);

             $request->getSession()->getFlashBag()->add('success', 'ajout avec succée !');
             return $this->redirectToRoute('backend_camion_liste');
        }

        return $this->render('Camion/form.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/edit/{id}", name="_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function editAction(Request $request, Camion $Camion)
    {

        $form = $this->createForm(CamionType::class, $Camion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $Camion = $this->CamionService->persist($Camion);
             $request->getSession()->getFlashBag()->add('success', 'modification avec succée !');
             return $this->redirectToRoute('backend_camion_liste');
        }

        return $this->render('Camion/form.html.twig', array('form' => $form->createView(),'ligne' => $Poste));
    }


    /**
     * @Route("/liste", name="_liste")
     */
    public function Camion()
    {
        $liste = $this->CamionService->getCamion();
        return $this->render('Camion/liste.html.twig', ['liste' => $liste]);
    }

    /**
     * @Route("/delete/{id}", name="_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteAction(Camion $Camion, Request $request)
    {
            try {
            $this->CamionService->remove($Camion);
            $request->getSession()->getFlashBag()->add('success', 'Camion supprimée avec succès !');
        } catch (\Exception $exception) {
             $request->getSession()->getFlashBag()->add('danger', 'un ou plusieurs produit liés  à cette entité   !');
        }


  
        return $this->redirectToRoute('backend_camion_liste');
    }
}
