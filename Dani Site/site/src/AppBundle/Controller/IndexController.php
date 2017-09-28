<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Article;
use AppBundle\Entity\Utilisateur;
use AppBundle\Entity\Commentaire;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Doctrine\ORM\EntityRepository;

class IndexController extends Controller
{

    /**
     * @Route("/dani", name="dani")
     */
    public function daniAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $bio = $em->getRepository('AppBundle:Bio')->findAll();

      $em->flush();
        return $this->render('default/front/front_bio.html.twig', array ('bio'=>$bio));
          }

    /**
     * @Route("/actualite", name="actualite")
     */
    public function actualiteAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $articlelist = $em->getRepository('AppBundle:Article')->findAll();

      $em->flush();
        return $this->render('default/front/front_actualite.html.twig', array ('actu'=>$articlelist));
    }

    /**
     * @Route("/concert", name="concert")
     */
    public function concertAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $concertlist = $em->getRepository('AppBundle:Concert')->findAll();

      $em->flush();
        return $this->render('default/front/front_concert.html.twig', array ('concert'=>$concertlist));
    }



    /**
     * @Route("/galerie", name="galerie")
     */
    public function galerieAction(Request $request)
    {
          }

    /**
     * @Route("/cinema", name="cinema")
     */
    public function cinemaAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $cinemalist = $em->getRepository('AppBundle:Cinema')->findAll();

      $em->flush();
        return $this->render('default/front/front_cinema.html.twig', array ('cinema'=>$cinemalist));
          }

    /**
     * @Route("/discographie", name="discographie")
     */
    public function discographieAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $discographielist = $em->getRepository('AppBundle:Discographie')->findAll();

      $em->flush();
        return $this->render('default/front/front_discographie.html.twig', array ('discographie'=>$discographielist));
          }

    /**
    * @Route("/back/", name="backoffice")
    */
      public function backAction(Request $request)
      {
        $em = $this->getDoctrine()->getManager();

        $articlelist = $em->getRepository('AppBundle:Article')->findAll();

        $em->flush();
          return $this->render('default/article/article_liste.html.twig', array ('article'=>$articlelist));
      }

}
