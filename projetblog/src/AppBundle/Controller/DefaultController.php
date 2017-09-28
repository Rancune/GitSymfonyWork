<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('Default/test.html.twig', array('test2'=>'Ceci est le contenu de la variable test','test1'=>'Ceci est le contenu de la variable test','test2'=>'Ceci est le contenu de la variable test'));
    }
}
