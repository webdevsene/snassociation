<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $this->loadUsers($manager);

        $manager->flush();
    }

    private function loadUsers(ObjectManager $manager): void
    {
        foreach ($this->getUserData() as [$email, $roles,  $password]) {
            $user = new User();
            $user->setPassword($this->passwordHasher->hashPassword($user, $password));
            $user->setEmail($email);
            $user->setRoles($roles);

            $manager->persist($user);
            $this->addReference($email, $user);
        }

        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            // $userData = [$email, $roles, $password];
            ['seneo@mis.gov.sn', ['ROLE_ADMIN'], 'kitten'],
            ['tom_admin@symfony.com', ['ROLE_ADMIN'], 'kitten'],
            ['john_user@symfony.com', ['ROLE_USER'], 'kitten'],
        ];
    }
}
