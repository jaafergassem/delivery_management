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




/**
 * Backend: Action controller.
 * @Route("/action", name="backend_action")
 *  @IsGranted("ROLE_LIVREUR")
*/

class ActionController extends AbstractController
{


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
    public function select(Request $request)
    {

      
        return $this->render('action/select.html.twig');
    }





}