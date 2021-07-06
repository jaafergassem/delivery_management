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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Backend: AgentPoste controller.
 * @Route("/AgentPoste", name="backend_agentPoste")
 * @IsGranted("ROLE_ADMIN")
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
    public function addAction(Request $request,UserPasswordEncoderInterface $encodert)
    {

        $AgentPoste = new AgentPoste();
        $form = $this->createForm(AgentPosteType::class, $AgentPoste);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newEncodedPassword = $encodert->encodePassword($AgentPoste, $AgentPoste->getPassword());
            $AgentPoste->setPassword($newEncodedPassword);
            $roles[]='ROLE_AGENT';
            $AgentPoste->setRoles($roles);
             $AgentPoste = $this->AgentPosteService->persist($AgentPoste);
             $this->addFlash('message', 'Utilisateur ajouté avec succès');

             $request->getSession()->getFlashBag()->add('success', 'ajout avec succée !');
             return $this->redirectToRoute('backend_agentPoste_liste');
        }

        return $this->render('AgentPoste/form.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/edit/{agentPoste}", name="_edit")
     
     */
    public function editAction(Request $request, AgentPoste $agentPoste)
    {

        $form = $this->createForm(AgentPosteType::class, $agentPoste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $agentPoste = $this->AgentPosteService->persist($agentPoste);
             $request->getSession()->getFlashBag()->add('success', 'modification avec succée !');
             return $this->redirectToRoute('backend_agentPoste_liste');
        }

        return $this->render('AgentPoste/form.html.twig', array('form' => $form->createView(),'ligne' => $agentPoste));
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
