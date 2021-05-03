<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\String\Slugger\AsciiSlugger;
use App\Form\AgentPosteType;
use App\Entity\AgentPoste;
use App\Services\AgentPosteService;

/**
 * Backend: AgentPoste controller.
 * @Route("/AgentPoste", name="backend_agentPoste")
*/
class AgentPosteController extends AbstractController
{


    public function __construct(AgentPosteService $AgentPosteService)
    {
        $this->AgentPosteService = $AgentPosteService;
    }


    /**
     * @Route("/add", name="_add")
     */
    public function addAction(Request $request)
    {

        $AgentPoste = new AgentPoste();
        $form = $this->createForm(AgentPosteType::class, $AgentPoste);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $AgentPoste = $this->AgentPosteService->persist($AgentPoste);

             $request->getSession()->getFlashBag()->add('success', 'ajout avec succée !');
             return $this->redirectToRoute('backend_agentPoste_liste');
        }

        return $this->render('AgentPoste/form.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/edit/{id}", name="_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function editAction(Request $request, AgentPoste $AgentPoste)
    {

        $form = $this->createForm(AgentPosteType::class, $AgentPoste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $AgentPoste = $this->AgentPosteService->persist($AgentPoste);
             $request->getSession()->getFlashBag()->add('success', 'modification avec succée !');
             return $this->redirectToRoute('backend_agentPoste_liste');
        }

        return $this->render('AgentPoste/form.html.twig', array('form' => $form->createView(),'ligne' => $AgentPoste));
    }


    /**
     * @Route("/liste", name="_liste")
     */
    public function getAgentPoste()
    {
        $liste = $this->AgentPosteService->getAgentPoste();
        return $this->render('AgentPoste/liste.html.twig', ['liste' => $liste]);
    }

    /**
     * @Route("/delete/{id}", name="_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteAction(AgentPoste $AgentPoste, Request $request)
    {
            try {
            $this->AgentPosteService->remove($AgentPoste);
            $request->getSession()->getFlashBag()->add('success', 'AgentPoste supprimée avec succès !');
        } catch (\Exception $exception) {
             $request->getSession()->getFlashBag()->add('danger', 'un ou plusieurs produit liés  à cette entité   !');
        }


  
        return $this->redirectToRoute('backend_agentPoste_liste');
    }
}
