<?php

namespace AppBundle\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
//use AppBundle\Form\Type\PostType;
use AppBundle\DataTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Symfony\Component\Form\Exception\TransformationFailedException;


class UserToTextTransformer implements DataTransformerInterface
{
    private $manager;
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    public function transform($user)
    {
        if (null === $user) {
            return '';
        }
        return $user->getName();
    }
    public function reverseTransform($userEmail)
    {
        if (!$userEmail) {
            return;
        }
        $user = $this->manager
            ->getRepository(User::class)
            ->findOneByEmail($userEmail);
        if (null === $user) {
            throw new TransformationFailedException(sprintf(
                'This email "%s" does not exist!',
                $userEmail
            ));
        }
        return $user;
    }
}