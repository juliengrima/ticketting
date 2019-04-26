<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="passwordpage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->redirectToRoute('fos_user_security_login');
    }

    /**
     * @Route("/home", name="homepage")
     */
    public function homePageAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }
}
