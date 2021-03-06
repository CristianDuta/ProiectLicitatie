<?php

namespace BusinessLogic;

use Database\Model\Base\UserQuery;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider implements UserProviderInterface
{
   /**
    * @var UserQuery
    */
   private $userQuery;

   public function __construct(UserQuery $userQuery = null)
   {
      if (!$userQuery instanceof UserQuery) {
         $this->userQuery = UserQuery::create();
      }
   }

   /**
    * @inheritdoc
    */
   public function loadUserByUsername($username)
   {
      $user = $this->userQuery->findOneByEmail($username);
      if (empty($user)) {
         throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
      }

      return new User($user->getEmail(), $user->getPassword(), explode(',', $user->getRoles()), true, true, true, true);
   }

   /**
    * @inheritdoc
    */
   public function refreshUser(UserInterface $user)
   {
      if (!$user instanceof User) {
         throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
      }

      return $this->loadUserByUsername($user->getUsername());
   }

   /**
    * @inheritdoc
    */
   public function supportsClass($class)
   {
      return $class === 'Symfony\Component\Security\Core\User\User';
   }
}