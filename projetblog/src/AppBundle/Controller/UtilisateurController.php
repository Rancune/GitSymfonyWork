<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Utilisateur;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UtilisateurController extends Controller
{


  /**
  * @Route("/utilisateur/nouveau", name="utilisateur_nouveau")
  */
    public function utilisateurNouveauAction(Request $request)
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
    * @Route("/utilisateur/mod/{id}", name="utilisateur_modif", requirements={"id": "\d+"})
    */
    public function utilisateurModificationAction(Request $request, $id)
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
  * @Route("/utilisateur/supp/{id}", name="utilisateur_suppr", requirements = {"id": "\d+"})
  */
    public function utilisateurSuppressionAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();

      $utilisateur = $em->getRepository('AppBundle:Utilisateur')->find($id);
      if ($utilisateur == null)
      {
        $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
        return $this->redirectToRoute('utilisateur_liste');
      }
      // $utilisateur->setPseudo('admin modifié'); pour modifier un pseudo utilisateur
      $utilisateur->setActif(false);
      $em->flush();

      $this->addFlash('info', "l'utilisateur a bien été désactivé.");

      return $this->redirectToRoute('utilisateur_liste');
    }


    /**
    * @Route("/utilisateur/active/{id}", name="utilisateur_active", requirements = {"id": "\d+"})
    */
      public function utilisateurActivationAction(Request $request, $id)
      {
        $em = $this->getDoctrine()->getManager();

        $utilisateur = $em->getRepository('AppBundle:Utilisateur')->find($id);
        if ($utilisateur == null)
        {
          $this->addFlash('erreur','Un problème est survenu. Veuillez réessayer plus tard.');
          return $this->redirectToRoute('utilisateur_liste');
        }
        // $utilisateur->setPseudo('admin modifié'); pour modifier un pseudo utilisateur
        $utilisateur->setActif(true);
        $em->flush();

        $this->addFlash('info', "l'utilisateur a bien été activé.");

        return $this->redirectToRoute('utilisateur_liste');
      }




    /**
     * @Route("/utilisateur/{id}", name="utilisateur_id", requirements={"id": "\d+"})
     */
    public function utilisateurAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();

      $utilisateur = $em->getRepository('AppBundle:Utilisateur')->find($id);

      if($utilisateur== null){
         throw $this->createNotFoundException('Article non trouvé.');
      }
      else
      {
        return new Response("User recupéré : ".$utilisateur->getPseudo());
      }
    }



    /**
     * @Route("/utilisateur/", name="utilisateur_liste")
     */
    public function utilisateurListeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $utilisateurList = $em->getRepository('AppBundle:Utilisateur')->findAll();

        return $this->render('default/utilisateur/utilisateur_liste.html.twig', array ('user' => $utilisateurList));
    }









}
