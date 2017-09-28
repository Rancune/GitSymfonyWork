<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Cinema;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class CinemaController extends Controller
{

/**
* @Route("/back/cinema/nouveau", name="cinema_nouveau")
*/
  public function CinemaNouveauAction(Request $request)
  {

        $cinema = new Cinema();


        $form = $this->createFormBuilder($cinema)
                      ->add('titre', TextType::class)
                      ->add('contenu', TextType::class)
                      ->add('moviereleasedate', DateType::class)

                      ->getForm();

         $form->handleRequest($request);


         if ($form->isSubmitted())
         {
            if(!$form->isValid())
            {
              $form->getErrors();
              return $this->render('default/cinema/cinema_nouveau.html.twig', array(
                        'form'=>$form->createView()));
            }

             $cinema= $form->getData();


              $em = $this->getDoctrine()->getManager();
              $em->persist($cinema);
              $em->flush();

              $this->addFlash('info', 'Nouveau super 8 ajouté.');

              return $this->render('default/cinema/cinema_nouveau.html.twig', array(
                  'form'=>$form->createView()));

         }

         return $this->render('default/cinema/cinema_nouveau.html.twig', array(
             'form'=>$form->createView()
         ));

  }



  /**
  * @Route("/back/cinema/mod/{id}", name="cinema_modif", requirements={"id": "\d+"})
  */
  public function CinemaModificationAction(Request $request, $id)
  {

    $em = $this->getDoctrine()->getManager();
    $cinema = $em->getRepository('AppBundle:Cinema')->find($id);
    if ($cinema == null)
    {
        throw $this->createNotFoundException('Film non trouvé.');
    }


    $form = $this->createFormBuilder($cinema)
                  ->add('titre', TextType::class)
                  ->add('contenu', TextType::class)
                  ->add('moviereleasedate', DateType::class)


                  ->getForm();

     $form->handleRequest($request);


     if ($form->isSubmitted())
     {
        if(!$form->isValid())
        {
          $form->getErrors();
          return $this->render('default/cinema/cinema_modif.html.twig', array(
                    'form'=>$form->createView()));
        }


         $cinema= $form->getData();



          $em = $this->getDoctrine()->getManager();
          $em->persist($cinema);
          $em->flush();

          $this->addFlash('info', 'Cinema modifié.');

          return $this->render('default/cinema/cinema_modif.html.twig', array(
              'form'=>$form->createView()));

     }

     return $this->render('default/cinema/cinema_modif.html.twig', array(
         'form'=>$form->createView()
     ));
  }





/**
* @Route("/back/cinema/supp/{id}", name="cinema_suppr", requirements = {"id": "\d+"})
*/
  public function CinemaSuppressionAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $cinema = $em->getRepository('AppBundle:Cinema')->find($id);
    if ($cinema == null)
    {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('Cinema_count');
    }
    // $utilisateur->setPseudo('admin modifié'); pour modifier un pseudo utilisateur
    $cinema->setActif(false);
    $em->flush();
    $this->addFlash('info', "le super 8 a bien été désactivé.");

    return $this->redirectToRoute('cinema_count');
  }


  /**
  * @Route("/back/cinema/active/{id}", name="cinema_active", requirements = {"id": "\d+"})
  */
    public function CinemaActivationAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();

      $cinema = $em->getRepository('AppBundle:Cinema')->find($id);
      if ($cinema == null)
      {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('cinema_count');
      }

      $cinema->setActif(true);
      $em->flush();

      $this->addFlash('info', "Super 8 Mega Master Dark Blade de la chouette activé.");

      return $this->redirectToRoute('cinema_count');
    }



  /**
   * @Route("/back/cinema/{id}", name="cinema_id", requirements={"id": "\d+"})
   */
  public function CinemaAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $cinema = $em->getRepository('AppBundle:Cinema')->find($id);

    if($cinema== null){
       throw $this->createNotFoundException('Cinema non trouvé.');
    }
    else
    {
      return new Response("Cinema recupéré : ".$cinema->getTitre());
    }
  }



  /**
  * @Route("/back/cinema/", name="cinema_count")
  */
    public function CinemaCountAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $cinemalist = $em->getRepository('AppBundle:Cinema')->findAll();

      $em->flush();
        return $this->render('default/cinema/cinema_liste.html.twig', array ('cinema'=>$cinemalist));
    }
}
