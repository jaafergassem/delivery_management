<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\String\Slugger\AsciiSlugger;
use App\Form\PaquetType;
use App\Entity\Paquet;
use App\Services\PaquetService;

/**
 * Backend: Paquet controller.
 * @Route("/paquet", name="backend_paquet")
 * @IsGranted("ROLE_AGENT")
*/
class PaquetController extends AbstractController
{


    public function __construct(PaquetService $PaquetService)
    {
        $this->PaquetService = $PaquetService;
    }



      /**
         * @Route("/verif", name="_verif")
         */
        public function verifier(Request $request): Response
        {
             $user = $this->getUser();

              


             $situation = $user->getPoste();
          
              $postedepart= $user->getPoste();

           
            $paquet = new Paquet();
            $form = $this->createForm(PaquetType::class, $paquet);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid() and  ! is_null( $request->get('code')) ) {
                
                $now= new \DateTime();
               $code = $request->get('code');


               $paquet->setCodeBarre($code);
               $paquet->setDateDepart($now);
               $paquet->setDateCreation($now);
               $paquet->setStatut('stock');

               $paquet->setPosteDepart($postedepart);
              
              
               $paquet->setAgent($user);

               $paquet->setSituation($situation);
               


               $paquet = $this->PaquetService->persist($paquet);
  
               $request->getSession()->getFlashBag()->add('success', 'ajout avec succée !');
               return $this->redirectToRoute('backend_paquet_verif');
          }

            if ( ! is_null( $request->get('code')) ) {

                
                $code = $request->get('code');
                $paquet = $this->PaquetService->findByCode($code);
                if(is_null($paquet) )
                {
                  $paquet = new Paquet();
                $form = $this->createForm(PaquetType::class, $paquet);
                return $this->render('Paquet/form.html.twig', array('form' => $form->createView(),'code' => $code));
                } 
                $form = $this->createForm(PaquetType::class, $paquet);
                return $this->render('Paquet/form.html.twig', array('form' => $form->createView(),'ligne' => $paquet,'code' => $code));
         
             }
             
           
         
            return $this->render('Paquet/verif.html.twig');
        }
 


    
      
            


    
    /**
     * @Route("/add", name="_add")
     */
    public function addAction(Request $request)
    {

        $Paquet = new Paquet();
        $form = $this->createForm(PaquetType::class, $Paquet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $Paquet = $this->PaquetService->persist($Paquet);

             $request->getSession()->getFlashBag()->add('success', 'ajout avec succée !');
             return $this->redirectToRoute('backend_paquet_liste');
        }

        return $this->render('Paquet/form.html.twig', array('form' => $form->createView()));
    }




     
    /**
     * @Route("/edit/{id}", name="_edit")
     */
    public function editAction(Request $request, Paquet $Paquet)
    {

        $form = $this->createForm(PaquetType::class, $Paquet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $Paquet = $this->PaquetService->persist($Paquet);
             $request->getSession()->getFlashBag()->add('success', 'modification avec succée !');
             return $this->redirectToRoute('backend_paquet_liste');
        }

        return $this->render('Paquet/modif.html.twig', array('form' => $form->createView(),'ligne' => $Paquet));
    }

    /**
     * @Route("/liste", name="_liste")
     */
    public function getPaquet()
    {
        $liste = $this->PaquetService->getPaquet();
        return $this->render('Paquet/historique.html.twig', ['liste' => $liste]);
       

    }

    /**
     * @Route("/delete/{id}", name="_delete")
     */
    public function deleteAction(Paquet $Paquet, Request $request)
    {
            try {
            $this->PaquetService->remove($Paquet);
            $request->getSession()->getFlashBag()->add('success', 'Paquet supprimée avec succès !');
        } catch (\Exception $exception) {
             $request->getSession()->getFlashBag()->add('danger', 'un ou plusieurs produit liés  à cette entité   !');
        }


  
        return $this->redirectToRoute('backend_paquet_liste');
    }
}
