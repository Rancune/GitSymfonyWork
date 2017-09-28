<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Article;


class CategorieController extends Controller
{


    /**
    * @Route("/categorie/nouveau", name="categorie_nouveau")
    */
      public function categorieNouveauAction(Request $request)
      {
        $utilisateur = new Utilisateur();


        $form = $this->createFormBuilder($utilisateur)
                      ->add('pseudo', TextType::class, array('label'=>'Pseudo'))
                      ->add('email', EmailType::class)
                      //->add('test', TextType::class, array('mapped'=> false)) //form va ignorer le check de type de valeur de ce champs car pas dans l'objet Utilisateur.
                      ->add('mdp', RepeatedType::class, array(
                          'type'=>PasswordType::class,
                          'invalid_message'=>'Les mots de passes sont différent.',
                          'first_options'=>array('label'=>'Mot de passe'),
                          'second_options'=>array('label'=>'Confirmer le mot de passe')
                      ))
                      ->getForm();

         $form->handleRequest($request);

         if ($form->isSubmitted())
         {
            if(!$form->isValid())
            {
              $form->getErrors();
              return $this->render('default/utilisateur/utilisateur_nouveau.html.twig', array(
                        'form'=>$form->createView()));
            }

             $utilisateur = $form->getData();
             $utilisateur->setDatecreation( new \DateTime());
             $utilisateur->setDatemodification( new \DateTime());

              $em = $this->getDoctrine()->getManager();
              $em->persist($utilisateur);
              $em->flush();

              $this->addFlash('info', 'user  créé.');

                return $this->render('default/utilisateur/utilisateur_nouveau.html.twig', array(
                          'form'=>$form->createView()

                        ));



         }

         return $this->render('default/utilisateur/utilisateur_nouveau.html.twig', array(
             'form'=>$form->createView()
         ));
      }



      /**
      * @Route("/categorie/mod/{id}", name="categorie_modif", requirements={"id": "\d+"})
      */
      public function categorieModificationAction(Request $request, $id)
      {
        $em = $this->getDoctrine()->getManager();

        $utilisateur = $em->getRepository('AppBundle:Utilisateur')->find($id);
        if ($utilisateur == null)
        {
          $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
          return $this->redirectToRoute('utilisateur_liste');
        }


        $form = $this->createFormBuilder($utilisateur)
                      ->add('pseudo', TextType::class, array('label'=>'Pseudo'))
                      ->add('email', EmailType::class)
                      //->add('test', TextType::class, array('mapped'=> false)) //form va ignorer le check de type de valeur de ce champs car pas dans l'objet Utilisateur.
                      ->add('mdp', RepeatedType::class, array(
                          'type'=>PasswordType::class,
                          'invalid_message'=>'Les mots de passes sont différent.',
                          'first_options'=>array('label'=>'Mot de passe'),
                          'second_options'=>array('label'=>'Confirmer le mot de passe')
                      ))
                      ->getForm();

         $form->handleRequest($request);

         if ($form->isSubmitted())
         {
            if(!$form->isValid())
            {
              $form->getErrors();
              return $this->render('default/utilisateur/utilisateur_modification.html.twig', array(
                        'form'=>$form->createView()));
            }

             $utilisateur = $form->getData();

             $utilisateur->setDatemodification( new \DateTime());

              $em = $this->getDoctrine()->getManager();
              $em->persist($utilisateur);
              $em->flush();

              $this->addFlash('info', 'user  Mofifié.');

                return $this->render('default/utilisateur/utilisateur_modification.html.twig', array(
                          'form'=>$form->createView()

                        ));



         }

         return $this->render('default/utilisateur/utilisateur_modification.html.twig', array(
             'form'=>$form->createView()
         ));

      }











  /**
  * @Route("/categorie/supp/{id}", name="categorie_suppr", requirements = {"id": "\d+"})
  */
    public function categorieSuppressionAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();

      $categorie = $em->getRepository('AppBundle:Categorie')->find($id);
      if ($categorie == null)
      {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('categorie_liste');
      }

      $categorie->setActif(false);
      $em->flush();

      $this->addFlash('info', "la categorie a bien été désactivé.");

      return $this->redirectToRoute('categorie_liste');
    }


    /**
    * @Route("/categorie/active/{id}", name="categorie_active", requirements = {"id": "\d+"})
    */
      public function categorieActivationAction(Request $request, $id)
      {
        $em = $this->getDoctrine()->getManager();

        $categorie = $em->getRepository('AppBundle:Categorie')->find($id);
        if ($categorie == null)
        {
          $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
          return $this->redirectToRoute('categorie_liste');
        }

        $categorie->setActif(true);
        $em->flush();

        $this->addFlash('info', "la categorie  a bien été activé.");

        return $this->redirectToRoute('categorie_liste');
      }


  /**
   * @Route("/categorie/{id}", name="categorie_id", requirements={"id": "\d+"})
   */
  public function categorieAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $categorie = $em->getRepository('AppBundle:Categorie')->find($id);

    if($categorie== null){
       throw $this->createNotFoundException('Article non trouvé.');
    }
    else
    {
      return new Response("categorie recupéré : ".$categorie->getNom());
    }
  }


  /**
   * @Route("/categorie/", name="categorie_liste")
   */
  public function categorieListeAction(Request $request)
  {
      $em = $this->getDoctrine()->getManager();

      $categorieList = $em->getRepository('AppBundle:Categorie')->findAll();

      return $this->render('default/categorie/categorie_liste.html.twig', array ('categorie' => $categorieList));
  }

  //
  //
  //
  // /**
  // * @Route("/article/", name="article_count")
  // */
  //   public function articleCountAction(Request $request)
  //   {
  //     $em = $this->getDoctrine()->getManager();
  //
  //     $articlelist = $em->getRepository('AppBundle:Article')->findAll();
  //
  //     $em->flush();
  //     return new Response("Nombre articles dans la base : ".count($articlelist));
  //   }
}
