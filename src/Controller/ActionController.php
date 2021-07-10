<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\String\Slugger\AsciiSlugger;
use App\Form\SelectType;
use App\Entity\Bordereau;
use App\Services\BordereauService;

use App\Form\BordereauType;







/**
 * Backend: Action controller.
 * @Route("/action", name="backend_action")
 *  @IsGranted("ROLE_LIVREUR")
*/

class ActionController extends AbstractController
{


    
    public function __construct(BordereauService $BordereauService)
    {
        $this->BordereauService = $BordereauService;
    }


 /**
     * @Route("/valider", name="_valider")
     */
    public function  valider(Request $request)
    {
      
        return $this->render('action/valider.html.twig');
    }

 
     /**
     * @Route("/select", name="_select")
     */
    public function getBordereau()
    {

    
        $liste = $this->BordereauService->getBordereau();
        return $this->render('bordereau/select.html.twig', ['liste' => $liste]);









        
        $bordereau = new Bordereau();
        $form = $this->createForm(SelectType::class, $bordereau);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $now= new \DateTime();
            
            $bordereau->setDateDepart($now);
            $bordereau->setStatut('En cours de livraison');
            $bordereau = $this->BordereauService->persist($bordereau);

            $request->getSession()->getFlashBag()->add('success', 'selectionné avec succée !');
           
       }
       return $this->redirectToRoute('backend_valider');
    }





}