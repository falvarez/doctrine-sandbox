<?php

/**
 * @method findAll
 * @return Product[]
 *
 * @method find($id)
 * @param int $id
 * @return Product
 */

class ProductManager extends AbstractManager
{
    const REPOSITORY = Product::class;

    /**
     * @param string $name
     * @return Product
     */
    public function create($name)
    {
        $product = new Product();
        $product->setName($name);

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $product;
    }

    /**
     * @param int $id
     * @param string $name
     * @return null|Product
     */
    public function update($id, $name)
    {
        /** @var Product $product */
        $product = $this->find($id);

        if ($product === null) {
            return null;
        }

        $product->setName($name);

        $this->entityManager->flush();

        return $product;
    }
}
