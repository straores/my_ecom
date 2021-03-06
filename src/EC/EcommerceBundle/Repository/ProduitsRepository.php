<?php

namespace EC\EcommerceBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProduitsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitsRepository extends EntityRepository
{
	public function findArray($array)
	{
		$qb = $this->createQueryBuilder('u')
				->Select('u')
				->Where('u.id IN (:array)')
				->setParameter('array', $array);

		return $qb->getQuery()->getResult();
	}
}
