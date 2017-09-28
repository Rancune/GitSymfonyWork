<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Article;
use AppBundle\Entity\Utilisateur;
use AppBundle\Entity\Image;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleController extends Controller
{

/**
* @Route("/back/article/nouveau", name="article_nouveau")
*/
  public function articleNouveauAction(Request $request)
  {


        $article = new Article();


        $form = $this->createFormBuilder($article)
                      ->add('titre', TextType::class)
                      ->add('contenu', TextareaType::class)
                      ->add('date', DateType::class)

                      ->addEventListener(FormEvents::PRE_SET_DATA,
                            function (FormEvent $event){
                            $form = $event->getForm();

                            $formOptions = array(
                                    'class'=> Utilisateur::class,
                                    'choice_label' => 'pseudo',
                                    'query_builder' =>function (EntityRepository $er)
                                      {
                                        return $er->createQueryBuilder('u')->where('u.actif = 1')->orderBy('u.pseudo','ASC');
                                      }
                            );

                            $form->add('Auteur', EntityType::class, $formOptions);
                      }
                    )
                    ->addEventListener(FormEvents::PRE_SET_DATA,
                          function (FormEvent $event){
                          $form = $event->getForm();

                          $formOptions = array(
                                  'class'=> Image::class,
                                  'choice_label' => 'titre',
                                  'query_builder' =>function (EntityRepository $er)
                                    {
                                      return $er->createQueryBuilder('u')->where('u.actif = 1')->orderBy('u.datecreation','ASC');
                                    }
                          );

                          $form->add('Image', EntityType::class, $formOptions);
                    }
                  )
                      ->getForm();

         $form->handleRequest($request);


         if ($form->isSubmitted())
         {
            if(!$form->isValid())
            {
              $form->getErrors();
              return $this->render('default/article/article_nouveau.html.twig', array(
                        'form'=>$form->createView()));
            }


             $article= $form->getData();
             $article->setDate( new \DateTime());
             $article->setDatecreation( new \DateTime());
             $article->setDatemodification( new \DateTime());


              $em = $this->getDoctrine()->getManager();
              $em->persist($article);
              $em->flush();

              $this->addFlash('info', 'article créé.');

              return $this->render('default/article/article_nouveau.html.twig', array(
                  'form'=>$form->createView()));

         }

         return $this->render('default/article/article_nouveau.html.twig', array(
             'form'=>$form->createView()
         ));

  }



  /**
  * @Route("/back/article/mod/{id}", name="article_modif", requirements={"id": "\d+"})
  */
  public function articleModificationAction(Request $request, $id)
  {

    $em = $this->getDoctrine()->getManager();
    $article = $em->getRepository('AppBundle:Article')->find($id);
    if ($article == null)
    {
        throw $this->createNotFoundException('article non trouvé.');
    }


    $form = $this->createFormBuilder($article)
                  ->add('titre', TextType::class)
                  ->add('contenu', TextareaType::class)

                  ->addEventListener(FormEvents::PRE_SET_DATA,
                        function (FormEvent $event){
                        $form = $event->getForm();

                        $formOptions = array(
                                'class'=> Utilisateur::class,
                                'choice_label' => 'pseudo',
                                'query_builder' =>function (EntityRepository $er)
                                  {
                                    return $er->createQueryBuilder('u')->where('u.actif = 1')->orderBy('u.pseudo','ASC');
                                  }
                        );

                        $form->add('Auteur', EntityType::class, $formOptions);
                  }
                )
                  ->getForm();

     $form->handleRequest($request);


     if ($form->isSubmitted())
     {
        if(!$form->isValid())
        {
          $form->getErrors();
          return $this->render('default/article/article_modif.html.twig', array(
                    'form'=>$form->createView()));
        }


         $article= $form->getData();

         $article->setDatemodification( new \DateTime());


          $em = $this->getDoctrine()->getManager();
          $em->persist($article);
          $em->flush();

          $this->addFlash('info', 'article modifié.');

          return $this->render('default/article/article_modif.html.twig', array(
              'form'=>$form->createView()));

     }

     return $this->render('default/article/article_modif.html.twig', array(
         'form'=>$form->createView()
     ));



  }





/**
* @Route("/back/article/supp/{id}", name="article_suppr", requirements = {"id": "\d+"})
*/
  public function articleSuppressionAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $article = $em->getRepository('AppBundle:Article')->find($id);
    if ($article == null)
    {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('article_count');
    }
    // $utilisateur->setPseudo('admin modifié'); pour modifier un pseudo utilisateur
    $article->setActif(false);
    $em->flush();
    $this->addFlash('info', "l'article a bien été désactivé.");

    return $this->redirectToRoute('article_count');
  }


  /**
  * @Route("/back/artcile/active/{id}", name="article_active", requirements = {"id": "\d+"})
  */
    public function articleActivationAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();

      $article = $em->getRepository('AppBundle:Article')->find($id);
      if ($article == null)
      {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('article_count');
      }
      // $utilisateur->setPseudo('admin modifié'); pour modifier un pseudo utilisateur
      $article->setActif(true);
      $em->flush();

      $this->addFlash('info', "l'article a bien été activé.");

      return $this->redirectToRoute('article_count');
    }



  /**
   * @Route("/back/article/{id}", name="article_id", requirements={"id": "\d+"})
   */
  public function articleAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $article = $em->getRepository('AppBundle:Article')->find($id);

    if($article== null){
       throw $this->createNotFoundException('Article non trouvé.');
    }
    else
    {
      return new Response("article recupéré : ".$article->getTitre());
    }
  }



  /**
  * @Route("/back/article/", name="article_count")
  */
    public function articleCountAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $articlelist = $em->getRepository('AppBundle:Article')->findAll();

      $em->flush();
        return $this->render('default/article/article_liste.html.twig', array ('article'=>$articlelist));
    }
}
