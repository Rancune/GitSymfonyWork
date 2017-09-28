<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Utilisateur;
use AppBundle\Entity\Article;

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


class CommentaireController extends Controller
{


    /**
    * @Route("/commentaire/{id}/nouveau", name="commentaire_nouveau", requirements={"id": "\d+"})
    */
      public function commentaireNouveauAction(Request $request, $id)
      {


        $em = $this->getDoctrine()->getManager();

        $articleexist = $em->getRepository('AppBundle:Article')->find($id);
        if ($articleexist == null)
        {
            throw $this->createNotFoundException('Article non trouvé.');
        }


        $commentaire = new Commentaire();
        $form = $this->createFormBuilder($commentaire)

                      ->add('contenu', TextareaType::class)

                      ->addEventListener(FormEvents::PRE_SET_DATA,//avant la création du formulaire
                            function (FormEvent $event){
                            $form = $event->getForm();

                            $formOptions = array(
                                    'class'=> Utilisateur::class,//achanger
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
              return $this->render('default/commentaire/commentaire_nouveau.html.twig', array(
                        'form'=>$form->createView()));
            }

             // Effectuer ici les actions avec la BDD (Doctrine)

             $commentaire= $form->getData();
             $commentaire->setArticle($articleexist);
             $commentaire->setDate( new \DateTime());
             $commentaire->setDatecreation( new \DateTime());
             $commentaire->setDatemodification( new \DateTime());


              $em = $this->getDoctrine()->getManager();
              $em->persist($commentaire);
              $em->flush();

              $this->addFlash('info', 'Commentaire créé.');

              return $this->render('default/commentaire/commentaire_nouveau.html.twig', array(
                  'form'=>$form->createView()));

         }

         return $this->render('default/commentaire/commentaire_nouveau.html.twig', array(
             'form'=>$form->createView()
         ));



/*
        $idart = $request->query->get('idart');
        $idauteur = $request->query->get('id');

        $em = $this->getDoctrine()->getManager();

        $utilisateur = $em->getRepository('AppBundle:Utilisateur')->find($idauteur);
        $article = $em->getRepository('AppBundle:Article')->find($idart);
        if ($article == null || $utilisateur == null )
        {
            throw $this->createNotFoundException('Article ou user non trouvé.');
        }

        $commentaire = new Commentaire();
        $commentaire->setArticle($article);
        $commentaire->setAuteur($utilisateur);
        $commentaire->setDate( new \DateTime());
        $commentaire->setContenu('contenu Commentaire');
        $commentaire->setDatecreation( new \DateTime());
        $commentaire->setDatemodification( new \DateTime());




         $em->persist($commentaire);
         $em->flush();

         return new Response('Commentaire Créé.  '.$article->getID().'  '.$utilisateur->getPseudo());
*/
      }



      /**
      * @Route("/commentaire/mod/{id}", name="commentaire_modif", requirements={"id": "\d+"})
      */
      public function commentaireModificationAction(Request $request, $id)
      {



                $em = $this->getDoctrine()->getManager();

                $commentaire = $em->getRepository('AppBundle:Commentaire')->find($id);
                if ($commentaire == null)
                {
                    throw $this->createNotFoundException('Commentaire non trouvé.');
                }



                $form = $this->createFormBuilder($commentaire)

                              ->add('contenu', TextareaType::class)

                              ->addEventListener(FormEvents::PRE_SET_DATA,//avant la création du formulaire
                                    function (FormEvent $event){
                                    $form = $event->getForm();

                                    $formOptions = array(
                                            'class'=> Utilisateur::class,//achanger
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
                      return $this->render('default/commentaire/commentaire_modification.html.twig', array(
                                'form'=>$form->createView()));
                    }

                     // Effectuer ici les actions avec la BDD (Doctrine)

                     $commentaire= $form->getData();

                    // $commentaire->setDate( new \DateTime());
                     //$commentaire->setDatecreation( new \DateTime());
                     $commentaire->setDatemodification( new \DateTime());


                      $em = $this->getDoctrine()->getManager();
                      $em->persist($commentaire);
                      $em->flush();

                      $this->addFlash('info', 'Commentaire modifié.');

                      return $this->render('default/commentaire/commentaire_modification.html.twig', array(
                          'form'=>$form->createView()));

                 }

                 return $this->render('default/commentaire/commentaire_modification.html.twig', array(
                     'form'=>$form->createView()
                 ));










/*
              $em = $this->getDoctrine()->getManager();

              $commentaire = $em->getRepository('AppBundle:Commentaire')->find($id);
              if ($commentaire == null)
              {
                  throw $this->createNotFoundException('Commentaire non trouvé.');
              }
              $commentaire->setContenu('Contenu de commentaire modifié');
              $em->flush(); // met à jour la bdd
              return new Response('Commentaire  modifié.');

*/
      }



    /**
    * @Route("/commentaire/supp/{id}", name="commentaire_suppr", requirements = {"id": "\d+"})
    */
      public function commentaireSuppressionAction(Request $request, $id)
      {
        $em = $this->getDoctrine()->getManager();

        $commentaire = $em->getRepository('AppBundle:Commentaire')->find($id);
        if ($commentaire == null)
        {
          $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
          return $this->redirectToRoute('commentaire_total');
        }
        // $utilisateur->setPseudo('admin modifié'); pour modifier un pseudo utilisateur
        $commentaire->setActif(false);
        $em->flush();

        $this->addFlash('info', "l'utilisateur a bien été supprimé.");

        return $this->redirectToRoute('commentaire_total');
      }



      /**
       * @Route("/commentaire/{id}", name="commentaire_id", requirements={"id": "\d+"})
       */
      public function commentaireAction(Request $request, $id)
      {
        $em = $this->getDoctrine()->getManager();

        $commentaire = $em->getRepository('AppBundle:Commentaire')->find($id);

        if($commentaire== null){
           throw $this->createNotFoundException('Commentaire non trouvé.');
        }
        else
        {
          return new Response("Commentaire recupéré : ".$commentaire->getContenu());
        }
      }



      /**
           * Récupération des commentaires présent dans un article
           *
           * @Route("/commentaire/{idart}/liste", name="commentaire_liste", requirements={"idart": "\d+"})
           */
          public function commentaireListeAction(Request $request, $idart)
          {
              $em = $this->getDoctrine()->getManager();

              $article = $em->getRepository('AppBundle:Article')->find($idart);
              if ($article == null)
              {
                  throw $this->createNotFoundException('Mauvais id d\'article.');
              }

              // On utilise les fonction findBy(Nom de variable) afin de faire une recherche SELECT * FROM table WHERE champ=valeur
              $commentaireList = $em->getRepository('AppBundle:Commentaire')->findByArticle($article);

              return $this->render('default/commentaire/commentaire.html.twig', array ('liste' => $commentaireList, 'article'=>$article, 'idart'=>$idart));
          }



          /**
               * Récupération des commentaires présent dans un article
               *
               * @Route("/commentaire/liste", name="commentaire_total")
               */
              public function commentaireTotalAction(Request $request)
              {
                  $em = $this->getDoctrine()->getManager();

                  // $article = $em->getRepository('AppBundle:Article')->find($idart);
                  // if ($article == null)
                  // {
                  //     throw $this->createNotFoundException('Mauvais id d\'article.');
                  // }

                  // On utilise les fonction findBy(Nom de variable) afin de faire une recherche SELECT * FROM table WHERE champ=valeur
                  $commentaireList = $em->getRepository('AppBundle:Commentaire')->findall();

                  return $this->render('default/commentaire/comliste.html.twig', array ('liste' => $commentaireList));
              }


}
