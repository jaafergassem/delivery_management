<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\String\Slugger\AsciiSlugger;
use App\Form\BordereauType;
use App\Entity\Bordereau;
use App\Services\BordereauService;

/**
 * Backend: Bordereau controller.
 * @Route("/bordereau", name="backend_bordereau")
 * @IsGranted("ROLE_AGENT")
*/
class BordereauController extends AbstractController
{


    public function __construct(BordereauService $BordereauService)
    {
        $this->BordereauService = $BordereauService;
    }



    /**
     * @Route("/add", name="_add")
     */
    public function addAction(Request $request)
    {
          
      $user = $this->getUser();
            
        $postedepart= $user->getPoste();
      

        $paquets= $user->getPaquets();



        $bordereau = new Bordereau();
        $form = $this->createForm(BordereauType::class, $bordereau);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $now= new \DateTime();
            
            $bordereau->setDateCreation($now);
            $bordereau->setAgent($user);
            $bordereau->setStatut('stock');
         

            $bordereau->setPosteDepart($postedepart);
            
         
              
           $variable= ''.$bordereau->getId();
       
           

           




             $bordereau = $this->BordereauService->persist($bordereau);

             $request->getSession()->getFlashBag()->add('success', 'ajout avec succée !');
             return $this->redirectToRoute('backend_bordereau_liste');
        }

        return $this->render('bordereau/form.html.twig', array('form' => $form->createView(),'paquets' => $paquets));
    }







    /**
     * @Route("/edit/{id}", name="_edit")
    */
    public function editAction(Request $request, Bordereau $Bordereau)
    {

        $form = $this->createForm(BordereauType::class, $Bordereau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $Bordereau = $this->BordereauService->persist($Bordereau);
             $request->getSession()->getFlashBag()->add('success', 'modification avec succée !');
             return $this->redirectToRoute('backend_Bordereau_liste');
        }

        return $this->render('bordereau/form.html.twig', array('form' => $form->createView(),'ligne' => $Bordereau));
    }


    /**
     * @Route("/liste", name="_liste")
     */
    public function getBordereau()
    {
        $liste = $this->BordereauService->getBordereau();
        return $this->render('bordereau/liste.html.twig', ['liste' => $liste]);
    }



    










    /**
     * @Route("/delete/{id}", name="_delete")
     
     */
    public function deleteAction(Bordereau $Bordereau, Request $request)
    {
            try {
            $this->BordereauService->remove($Bordereau);
            $request->getSession()->getFlashBag()->add('success', 'Bordereau supprimée avec succès !');
        } catch (\Exception $exception) {
             $request->getSession()->getFlashBag()->add('danger', 'un ou plusieurs produit liés  à cette entité   !');
        }


  
        return $this->redirectToRoute('backend_bordereau_liste');
    }




















}
