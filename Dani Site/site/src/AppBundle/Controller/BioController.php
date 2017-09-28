<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Bio;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class BioController extends Controller
{

/**
* @Route("/back/bio/nouveau", name="bio_nouveau")
*/
  public function BioNouveauAction(Request $request)
  {

        $bio = new Bio();


        $form = $this->createFormBuilder($bio)
                      ->add('titre', TextType::class)
                      ->add('contenu', TextareaType::class)


                      ->getForm();

         $form->handleRequest($request);


         if ($form->isSubmitted())
         {
            if(!$form->isValid())
            {
              $form->getErrors();
              return $this->render('default/bio/bio_nouveau.html.twig', array(
                        'form'=>$form->createView()));
            }

             $bio= $form->getData();



              $em = $this->getDoctrine()->getManager();
              $em->persist($bio);
              $em->flush();

              $this->addFlash('info', 'Bio créé.');

              return $this->render('default/bio/bio_nouveau.html.twig', array(
                  'form'=>$form->createView()));

         }

         return $this->render('default/bio/bio_nouveau.html.twig', array(
             'form'=>$form->createView()
         ));

  }



  /**
  * @Route("/back/bio/mod/{id}", name="bio_modif", requirements={"id": "\d+"})
  */
  public function BioModificationAction(Request $request, $id)
  {

    $em = $this->getDoctrine()->getManager();
    $bio = $em->getRepository('AppBundle:Bio')->find($id);
    if ($bio == null)
    {
        throw $this->createNotFoundException('Bio non trouvé.');
    }


    $form = $this->createFormBuilder($bio)
    ->add('titre', TextType::class)
    ->add('contenu', TextareaType::class)


                  ->getForm();

     $form->handleRequest($request);


     if ($form->isSubmitted())
     {
        if(!$form->isValid())
        {
          $form->getErrors();
          return $this->render('default/bio/bio_modif.html.twig', array(
                    'form'=>$form->createView()));
        }

         $bio= $form->getData();



          $em = $this->getDoctrine()->getManager();
          $em->persist($bio);
          $em->flush();

          $this->addFlash('info', 'Bio modifié.');

          return $this->render('default/bio/bio_modif.html.twig', array(
              'form'=>$form->createView()));

     }

     return $this->render('default/bio/bio_modif.html.twig', array(
         'form'=>$form->createView()
     ));



  }





/**
* @Route("/back/bio/supp/{id}", name="bio_suppr", requirements = {"id": "\d+"})
*/
  public function BioSuppressionAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $bio = $em->getRepository('AppBundle:Bio')->find($id);
    if ($bio == null)
    {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('Bio_count');
    }
    // $utilisateur->setPseudo('admin modifié'); pour modifier un pseudo utilisateur
    $bio->setActif(false);
    $em->flush();
    $this->addFlash('info', "l'Bio a bien été désactivé.");

    return $this->redirectToRoute('bio_count');
  }


  /**
  * @Route("/back/bio/active/{id}", name="bio_active", requirements = {"id": "\d+"})
  */
    public function BioActivationAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();

      $bio = $em->getRepository('AppBundle:Bio')->find($id);
      if ($bio == null)
      {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('bio_count');
      }

      $bio->setActif(true);
      $em->flush();

      $this->addFlash('info', "Bio activé.");

      return $this->redirectToRoute('bio_count');
    }



  /**
   * @Route("/back/bio/{id}", name="bio_id", requirements={"id": "\d+"})
   */
  public function BioAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $bio = $em->getRepository('AppBundle:Bio')->find($id);

    if($bio== null){
       throw $this->createNotFoundException('Bio non trouvé.');
    }
    else
    {
      return new Response("Bio recupéré : ".$bio->getTitre());
    }
  }



  /**
  * @Route("/back/bio/", name="bio_count")
  */
    public function BioCountAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $biolist = $em->getRepository('AppBundle:Bio')->findAll();

      $em->flush();
        return $this->render('default/bio/bio_liste.html.twig', array ('bio'=>$biolist));
    }
}
