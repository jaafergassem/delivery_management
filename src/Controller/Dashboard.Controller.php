<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class HomeController extends AbstractController
{
    /**
     * @Route("/dashboard", name="homepage")

     */
    public function dashboard(): Response
    {
        

        return $this->render('dashboard.html.twig');
    }

}

  