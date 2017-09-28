<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Concert;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class ConcertController extends Controller
{

/**
* @Route("/back/concert/nouveau", name="concert_nouveau")
*/
  public function ConcertNouveauAction(Request $request)
  {

        $concert = new Concert();


        $form = $this->createFormBuilder($concert)
                      ->add('ville', TextType::class)
                      ->add('salle', TextType::class)
                      ->add('date', DateType::class)

                      ->getForm();

         $form->handleRequest($request);


         if ($form->isSubmitted())
         {
            if(!$form->isValid())
            {
              $form->getErrors();
              return $this->render('default/concert/concert_nouveau.html.twig', array(
                        'form'=>$form->createView()));
            }

             $concert= $form->getData();

              $em = $this->getDoctrine()->getManager();
              $em->persist($concert);
              $em->flush();

              $this->addFlash('info', 'Concert créé.');

              return $this->render('default/concert/concert_nouveau.html.twig', array(
                  'form'=>$form->createView()));

         }

         return $this->render('default/concert/concert_nouveau.html.twig', array(
             'form'=>$form->createView()
         ));

  }



  /**
  * @Route("/back/concert/mod/{id}", name="concert_modif", requirements={"id": "\d+"})
  */
  public function ConcertModificationAction(Request $request, $id)
  {

    $em = $this->getDoctrine()->getManager();
    $concert = $em->getRepository('AppBundle:Concert')->find($id);
    if ($concert == null)
    {
        throw $this->createNotFoundException('Concert non trouvé.');
    }


    $form = $this->createFormBuilder($concert)
                  ->add('ville', TextType::class)
                  ->add('salle', TextType::class)
                  ->add('date', DateType::class)


                  ->getForm();

     $form->handleRequest($request);


     if ($form->isSubmitted())
     {
        if(!$form->isValid())
        {
          $form->getErrors();
          return $this->render('default/concert/concert_modif.html.twig', array(
                    'form'=>$form->createView()));
        }


         $concert= $form->getData();



          $em = $this->getDoctrine()->getManager();
          $em->persist($concert);
          $em->flush();

          $this->addFlash('info', 'Concert modifié.');

          return $this->render('default/concert/concert_modif.html.twig', array(
              'form'=>$form->createView()));

     }

     return $this->render('default/concert/concert_modif.html.twig', array(
         'form'=>$form->createView()
     ));



  }





/**
* @Route("/back/concert/supp/{id}", name="concert_suppr", requirements = {"id": "\d+"})
*/
  public function ConcertSuppressionAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $concert = $em->getRepository('AppBundle:Concert')->find($id);
    if ($concert == null)
    {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('Concert_count');
    }

    $concert->setActif(false);
    $em->flush();
    $this->addFlash('info', "l'Concert a bien été désactivé.");

    return $this->redirectToRoute('concert_count');
  }


  /**
  * @Route("/back/concert/active/{id}", name="concert_active", requirements = {"id": "\d+"})
  */
    public function ConcertActivationAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();

      $concert = $em->getRepository('AppBundle:Concert')->find($id);
      if ($concert == null)
      {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('concert_count');
      }

      $concert->setActif(true);
      $em->flush();

      $this->addFlash('info', "Concert activé.");

      return $this->redirectToRoute('concert_count');
    }



  /**
   * @Route("/back/concert/{id}", name="concert_id", requirements={"id": "\d+"})
   */
  public function ConcertAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $concert = $em->getRepository('AppBundle:Concert')->find($id);

    if($concert== null){
       throw $this->createNotFoundException('Concert non trouvé.');
    }
    else
    {
      return new Response("Concert recupéré : ".$concert->getTitre());
    }
  }



  /**
  * @Route("/back/concert/", name="concert_count")
  */
    public function ConcertCountAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $concertlist = $em->getRepository('AppBundle:Concert')->findAll();

      $em->flush();
        return $this->render('default/concert/concert_liste.html.twig', array ('concert'=>$concertlist));
    }
}
