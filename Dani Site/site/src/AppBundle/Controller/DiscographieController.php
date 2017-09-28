<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Discographie;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class DiscographieController extends Controller
{

/**
* @Route("/back/discographie/nouveau", name="discographie_nouveau")
*/
  public function DiscographieNouveauAction(Request $request)
  {

        $discographie = new Discographie();


        $form = $this->createFormBuilder($discographie)
                      ->add('titre', TextType::class)
                      ->add('contenu', TextType::class)
                      ->add('discreleasedate', DateType::class)

                      ->getForm();

         $form->handleRequest($request);


         if ($form->isSubmitted())
         {
            if(!$form->isValid())
            {
              $form->getErrors();
              return $this->render('default/discographie/discographie_nouveau.html.twig', array(
                        'form'=>$form->createView()));
            }

             $discographie= $form->getData();


              $em = $this->getDoctrine()->getManager();
              $em->persist($discographie);
              $em->flush();

              $this->addFlash('info', 'Nouveau 33 tours ajouté.');

              return $this->render('default/discographie/discographie_nouveau.html.twig', array(
                  'form'=>$form->createView()));

         }

         return $this->render('default/discographie/discographie_nouveau.html.twig', array(
             'form'=>$form->createView()
         ));

  }



  /**
  * @Route("/back/discographie/mod/{id}", name="discographie_modif", requirements={"id": "\d+"})
  */
  public function DiscographieModificationAction(Request $request, $id)
  {

    $em = $this->getDoctrine()->getManager();
    $discographie = $em->getRepository('AppBundle:Discographie')->find($id);
    if ($discographie == null)
    {
        throw $this->createNotFoundException('Discographie non trouvé.');
    }


    $form = $this->createFormBuilder($discographie)
                  ->add('titre', TextType::class)
                  ->add('contenu', TextType::class)
                  ->add('discreleasedate', DateType::class)


                  ->getForm();

     $form->handleRequest($request);


     if ($form->isSubmitted())
     {
        if(!$form->isValid())
        {
          $form->getErrors();
          return $this->render('default/discographie/discographie_modif.html.twig', array(
                    'form'=>$form->createView()));
        }


         $discographie= $form->getData();



          $em = $this->getDoctrine()->getManager();
          $em->persist($discographie);
          $em->flush();

          $this->addFlash('info', 'Discographie modifié.');

          return $this->render('default/discographie/discographie_modif.html.twig', array(
              'form'=>$form->createView()));

     }

     return $this->render('default/discographie/discographie_modif.html.twig', array(
         'form'=>$form->createView()
     ));
  }





/**
* @Route("/back/discographie/supp/{id}", name="discographie_suppr", requirements = {"id": "\d+"})
*/
  public function DiscographieSuppressionAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $discographie = $em->getRepository('AppBundle:Discographie')->find($id);
    if ($discographie == null)
    {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('Discographie_count');
    }

    $discographie->setActif(false);
    $em->flush();
    $this->addFlash('info', "l'Discographie a bien été désactivé.");

    return $this->redirectToRoute('discographie_count');
  }


  /**
  * @Route("/back/discographie/active/{id}", name="discographie_active", requirements = {"id": "\d+"})
  */
    public function DiscographieActivationAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();

      $discographie = $em->getRepository('AppBundle:Discographie')->find($id);
      if ($discographie == null)
      {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('discographie_count');
      }

      $discographie->setActif(true);
      $em->flush();

      $this->addFlash('info', "CD LASER de Dorothé activé.");

      return $this->redirectToRoute('discographie_count');
    }



  /**
   * @Route("/back/discographie/{id}", name="discographie_id", requirements={"id": "\d+"})
   */
  public function DiscographieAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $discographie = $em->getRepository('AppBundle:Discographie')->find($id);

    if($discographie== null){
       throw $this->createNotFoundException('Discographie non trouvé.');
    }
    else
    {
      return new Response("Discographie recupéré : ".$discographie->getTitre());
    }
  }



  /**
  * @Route("/back/discographie/", name="discographie_count")
  */
    public function DiscographieCountAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $discographielist = $em->getRepository('AppBundle:Discographie')->findAll();

      $em->flush();
        return $this->render('default/discographie/discographie_liste.html.twig', array ('discographie'=>$discographielist));
    }
}
