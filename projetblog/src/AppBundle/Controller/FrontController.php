<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Article;
use AppBundle\Entity\Utilisateur;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FrontController extends Controller
{



  /**
   * @Route("/blog/article/{id}", name="article_id", requirements={"id": "\d+"})
   */
  public function articleAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $article = $em->getRepository('AppBundle:Article')->find($id);
    $commentaire = $em->getRepository('AppBundle:Commentaire')->find($id);


    $em->flush();
      return $this->render('default/front/front_article.html.twig', array ('article'=>$article; 'commentaire'=>$commentaire));
  }



  /**
  * @Route("/blog/", name="article_count")
  */
    public function articleCountAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $articlelist = $em->getRepository('AppBundle:Article')->findAll();

      $em->flush();
        return $this->render('default/front/front_liste.html.twig', array ('liste'=>$articlelist));
    }
}
