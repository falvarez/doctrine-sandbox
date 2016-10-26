<?php

class BugManager extends AbstractManager
{
    const REPOSITORY = 'Bug';

    /**
     * @param int $reporterId
     * @param int $defaultEngineerId
     * @param int[] $productIds
     * @return null|Bug
     */
    public function create($reporterId, $defaultEngineerId, $productIds)
    {
        $userManager = new UserManager($this->entityManager);

        /** @var User $reporter */
        $reporter = $userManager->find($reporterId);
        /** @var User $engineer */
        $engineer = $userManager->find($defaultEngineerId);
        if (!$reporter || !$engineer) {
            return null;
        }

        $bug = new Bug();
        $bug->setDescription("Something does not work!");
        $bug->setCreated(new DateTime("now"));
        $bug->setStatus("OPEN");

        $productManager = new ProductManager($this->entityManager);
        foreach ($productIds as $productId) {
            $product = $productManager->find($productId);
            $bug->assignToProduct($product);
        }

        $bug->setReporter($reporter);
        $bug->setEngineer($engineer);

        $this->entityManager->persist($bug);
        $this->entityManager->flush();

        return $bug;
    }

    /**
     * @param bool $hydrate
     * @return Bug[]
     */
    public function findAllDQL($hydrate = false)
    {
        $dql = "SELECT b, e, r, p FROM Bug b JOIN b.engineer e JOIN b.reporter r JOIN b.products p ORDER BY b.created DESC";

        $query = $this->entityManager->createQuery($dql);
        $query->setMaxResults(30);
        if ($hydrate) {
            return $query->getArrayResult();
        }

        return $query->getResult();
    }
}
