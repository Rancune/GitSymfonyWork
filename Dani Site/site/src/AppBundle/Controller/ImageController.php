<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Image;
use AppBundle\Entity\Article;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ImageController extends Controller
{

/**
* @Route("/back/image/nouveau", name="image_nouveau")
*/
  public function imageNouveauAction(Request $request)
  {


        $image = new Image();


        $form = $this->createFormBuilder($image)
                      ->add('titre', TextType::class)
                      ->add('adresse', TextareaType::class)

                      ->getForm();

         $form->handleRequest($request);


         if ($form->isSubmitted())
         {
            if(!$form->isValid())
            {
              $form->getErrors();
              return $this->render('default/image/image_nouveau.html.twig', array(
                        'form'=>$form->createView()));
            }




             $image= $form->getData();

             $image->setDatecreation( new \DateTime());



              $em = $this->getDoctrine()->getManager();
              $em->persist($image);
              $em->flush();

              $this->addFlash('info', 'adresse Image ajoutée et non pas Upload.');

              return $this->render('default/image/image_nouveau.html.twig', array(
                  'form'=>$form->createView()));

         }

         return $this->render('default/image/image_nouveau.html.twig', array(
             'form'=>$form->createView()
         ));

  }



  /**
  * @Route("/back/image/mod/{id}", name="image_modif", requirements={"id": "\d+"})
  */
  public function imageModificationAction(Request $request, $id)
  {

    $em = $this->getDoctrine()->getManager();
    $image = $em->getRepository('AppBundle:Image')->find($id);
    if ($image == null)
    {
        throw $this->createNotFoundException('image non trouvé.');
    }


    $form = $this->createFormBuilder($image)
                  ->add('titre', TextType::class)
                  ->add('adresse', TextareaType::class)

                  ->addEventListener(FormEvents::PRE_SET_DATA,//avant la création du formulaire
                        function (FormEvent $event){
                        $form = $event->getForm();

                        $formOptions = array(
                                'class'=> Article::class,//achanger
                                'choice_label' => 'titre',
                                'query_builder' =>function (EntityRepository $er)
                                  {
                                    return $er->createQueryBuilder('u')->where('u.actif = 1')->orderBy('u.titre','ASC');
                                  }
                        );

                        $form->add('Article', EntityType::class, $formOptions);
                  }
                )
                  ->getForm();

     $form->handleRequest($request);


     if ($form->isSubmitted())
     {
        if(!$form->isValid())
        {
          $form->getErrors();
          return $this->render('default/image/image_modif.html.twig', array(
                    'form'=>$form->createView()));
        }

         $image= $form->getData();



          $em = $this->getDoctrine()->getManager();
          $em->persist($image);
          $em->flush();

          $this->addFlash('info', 'image modifié.');

          return $this->render('default/image/image_modif.html.twig', array(
              'form'=>$form->createView()));

     }

     return $this->render('default/image/image_modif.html.twig', array(
         'form'=>$form->createView()
     ));

  }





/**
* @Route("/back/image/supp/{id}", name="image_suppr", requirements = {"id": "\d+"})
*/
  public function imageSuppressionAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $image = $em->getRepository('AppBundle:Image')->find($id);
    if ($image == null)
    {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('image_count');
    }
    // $utilisateur->setPseudo('admin modifié'); pour modifier un pseudo utilisateur
    $image->setActif(false);
    $em->flush();
    $this->addFlash('info', "l'image a bien été désactivé.");

    return $this->redirectToRoute('image_count');
  }


  /**
  * @Route("/back/artcile/active/{id}", name="image_active", requirements = {"id": "\d+"})
  */
    public function imageActivationAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();

      $image = $em->getRepository('AppBundle:Image')->find($id);
      if ($image == null)
      {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('image_count');
      }

      $image->setActif(true);
      $em->flush();

      $this->addFlash('info', "l'image a bien été activé.");

      return $this->redirectToRoute('image_count');
    }



  /**
   * @Route("/back/image/{id}", name="image_id", requirements={"id": "\d+"})
   */
  public function imageAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $image = $em->getRepository('AppBundle:Image')->find($id);

    if($image== null){
       throw $this->createNotFoundException('Image non trouvé.');
    }
    else
    {
      return new Response("image recupéré : ".$image->getTitre());
    }
  }



  /**
  * @Route("/back/image/", name="image_count")
  */
    public function imageCountAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $imagelist = $em->getRepository('AppBundle:Image')->findAll();

      $em->flush();
        return $this->render('default/image/image_liste.html.twig', array ('image'=>$imagelist));
    }
}
