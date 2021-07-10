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
use App\Form\AffecterType;
use App\Entity\Livreur;
use App\Services\LivreurService;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
/**
 * Backend: Livreur controller.
 * @Route("/livreur", name="backend_livreur")
 *  @IsGranted("ROLE_ADMIN")
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
    public function addAction(Request $request,UserPasswordEncoderInterface $encodert)
    {

        $Livreur = new Livreur();
        $form = $this->createForm(LivreurType::class, $Livreur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newEncodedPassword = $encodert->encodePassword($Livreur, $Livreur->getPassword());
            $Livreur->setPassword($newEncodedPassword);
            $roles[]='ROLE_LIVREUR';
            $Livreur->setRoles($roles);

             $Livreur = $this->LivreurService->persist($Livreur);

             $request->getSession()->getFlashBag()->add('success', 'ajout avec succée !');
             return $this->redirectToRoute('backend_livreur_liste');
        }

        return $this->render('Livreur/form.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/edit/{livreur}", name="_edit")
    
     */
    public function editAction(Request $request, Livreur $livreur)
    {

        $form = $this->createForm(LivreurType::class, $livreur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $livreur = $this->LivreurService->persist($livreur);
             $request->getSession()->getFlashBag()->add('success', 'modification avec succée !');
             return $this->redirectToRoute('backend_livreur_liste');
        }

        return $this->render('Livreur/form.html.twig', array('form' => $form->createView(),'ligne' => $livreur));
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
     * @Route("/affecter", name="_affecter")
     */
    public function affecter(Request $request)
    {

       
        $form = $this->createForm(AffecterType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $data = $form->getData() ;
          
            Dump($data) ;
            Die() ;
            
            $request->getSession()->getFlashBag()->add('success', 'ajout avec succée !');
            // return $this->redirectToRoute('backend_livreur_affectationliste');
        }

        return $this->render('livreur/affecter.html.twig', array('form' => $form->createView()));
    }


























    /**
     * @Route("/delete/{id}", name="_delete")
     
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
