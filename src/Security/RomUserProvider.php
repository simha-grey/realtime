<?php
namespace App\Security;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\Exception\ORMException;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use App\Entity\User;

class RomUserProvider implements UserProviderInterface, PasswordUpgraderInterface, OAuthAwareUserProviderInterface
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Symfony calls this method if you use features like switch_user
     * or remember_me. If you're not using these features, you do not
     * need to implement this method.
     *
     * @throws UserNotFoundException if the user is not found
     * @throws NotSupported
     */
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->entityManager->getRepository(User::class)->findUserByIdentifier($identifier);

        if(!$user){
            throw new UserNotFoundException('There is no such user: '.$identifier);
        }

        return $user;
    }

    /**
     * Refreshes the user after being reloaded from the session.
     *
     * @throws NotSupported
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        $identifier = $user->getUserIdentifier();

        $user = $this->entityManager->getRepository(User::class)->findUserByIdentifier($identifier);

        if (!$user) {
            throw new UserNotFoundException('There is no such user: '.$identifier);
        }

        return $user;
    }

    /**
     * Tells Symfony to use this provider for this User class.
     */
    public function supportsClass(string $class): bool
    {
        return User::class === $class || is_subclass_of($class, User::class);
    }

    /**
     * Upgrades the hashed password of a user, typically for using a better hash algorithm.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        $user->setPassword($newHashedPassword);

        $this->entityManager->flush();

    }

    /**
     * @throws NotSupported
     * @throws ORMException
     * @throws \Exception
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response): UserInterface|User
    {
        $identifier = $response->getUserIdentifier();
        $username = $response->getFirstName();
        $email = $response->getEmail();
        $service = $response->getResourceOwner()->getName();
        $setter = 'set'.ucfirst($service);
        $setter_id = $setter.'Id';
        $setter_token = $setter.'AccessToken';

        if(!method_exists(User::class,$setter_id) || !method_exists(User::class,$setter_token)){
            throw new \Exception('Not supported resource owner.');
        }

        $user = $this->entityManager->getRepository(User::class)->findUserByIdentifier($email);

        if (null === $user) {
            // create new user here
            $user = new User();
            $user->$setter_id($identifier);
            $user->$setter_token($response->getAccessToken());
            $user->setName($username);
            $user->setEmail($email);
            //$user->setPassword($username);
            $user->setIsVerified(true);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return $user;
        }
        //update access token
        $user->$setter_token($response->getAccessToken());

        return $user;
    }
}