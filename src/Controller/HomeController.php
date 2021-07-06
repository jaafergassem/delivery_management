<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="homepage")
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
        

        return $this->render('home.html.twig');
    }

}

  