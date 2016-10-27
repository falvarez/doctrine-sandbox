<?php

use Doctrine\ORM\EntityRepository;

class BugRepository extends EntityRepository
{
    /**
     * @param int $number
     * @return Bug[]
     */
    public function getRecentBugs($number = 30)
    {
        $dql = "SELECT b, e, r FROM Bug b JOIN b.engineer e JOIN b.reporter r ORDER BY b.created DESC";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setMaxResults($number);
        return $query->getResult();
    }

    /**
     * @param int $number
     * @return array
     */
    public function getRecentBugsArray($number = 30)
    {
        $dql = "SELECT b, e, r, p FROM Bug b JOIN b.engineer e ".
            "JOIN b.reporter r JOIN b.products p ORDER BY b.created DESC";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setMaxResults($number);
        return $query->getArrayResult();
    }

    /**
     * @param int $userId
     * @param int $number
     * @return Bug[]
     */
    public function getUsersBugs($userId, $number = 15)
    {
        $statusOpen = Bug::STATUS_OPEN;
        $dql = "SELECT b, e, r FROM Bug b JOIN b.engineer e JOIN b.reporter r ".
            "WHERE b.status = '$statusOpen' AND e.id = ?1 OR r.id = ?1 ORDER BY b.created DESC";

        return $this->getEntityManager()->createQuery($dql)
            ->setParameter(1, $userId)
            ->setMaxResults($number)
            ->getResult();
    }

    /**
     * @return array
     */
    public function getOpenBugsByProduct()
    {
        $statusOpen = Bug::STATUS_OPEN;
        $dql = "SELECT p.id, p.name, count(b.id) AS openBugs FROM Bug b ".
            "JOIN b.products p WHERE b.status = '$statusOpen' GROUP BY p.id";
        return $this->getEntityManager()->createQuery($dql)->getScalarResult();
    }
}
