<?php

namespace FWM\CraftyComponentsBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ComponentsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ComponentsRepository extends EntityRepository
{

    public function getNew($craftyComponentsConfig) {
        return $this->_em->createQueryBuilder()
                ->from('FWMCraftyComponentsBundle:Components', 'cr')
                ->select('cr', 'v')
                ->andWhere('cr.isActive = true')
                ->andWhere('cr.id != '.$craftyComponentsConfig['crafty']['id'])
                ->leftJoin('cr.versions', 'v')
                ->orderBy('cr.createdAt', 'DESC')
                ->getQuery();
    }

    public function getOneWithVersions($id) {
        return $this->_em->createQueryBuilder()
                ->from('FWMCraftyComponentsBundle:Components', 'cr')
                ->select('cr', 'v')
                ->andWhere('cr.isActive = true')
                ->andWhere('cr.id = :id')
                ->leftJoin('cr.versions', 'v')
                ->setParameters(array('id' => $id))
                ->orderBy('v.value', 'ASC')
                ->getQuery();
    }

}