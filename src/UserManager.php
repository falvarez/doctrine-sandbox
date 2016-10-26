<?php

class UserManager extends AbstractManager
{
    const REPOSITORY = 'User';

    /**
     * @param string $name
     * @return User
     */
    public function create($name)
    {
        $user = new User();
        $user->setName($name);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}
