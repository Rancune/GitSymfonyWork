<?php

namespace AppBundle\Repository;

/**
 * CommentaireRepository
 *
 *
 */
class CommentaireRepository extends \Doctrine\ORM\EntityRepository
{

  public function findAllCommentaire($recherche)
  {
    $em = $this->getEntityManager();
      $query = $em->createQuery("SELECT COUNT(u) FROM AppBundle:Commentaire a  WHERE a.id LIKE ''%:recherche%'")
                  ->setParameter('recherche', $recherche);

      return $query->getSingleScalarResult();

  }
}
