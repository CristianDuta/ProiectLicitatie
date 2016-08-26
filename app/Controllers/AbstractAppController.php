<?php

namespace Controllers;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\User;

abstract class AbstractAppController implements ControllerProviderInterface
{
    /** @var ControllerCollection */
    private $controllerCollection;

    /**
     * @return ControllerCollection
     */
    public function getControllerCollection()
    {
        return $this->controllerCollection;
    }

    /**
     * @param ControllerCollection $controllerCollection
     */
    public function setControllerCollection($controllerCollection)
    {
        $this->controllerCollection = $controllerCollection;
    }

    /**
     * @param Application $app
     * @return null|string
     */
    protected function getUsername(Application $app)
    {
        /** @var UsernamePasswordToken $token */
        $token = $app['security.token_storage']->getToken();

        if (!$token instanceof UsernamePasswordToken) {
            return null;
        }

        /** @var User $user */
        $user = $token->getUser();

        if (!$user instanceof User) {
            return null;
        }

        return $user->getUsername();
    }

    /**
     * @param Application $app
     * @return null|User
     */
    protected function getUser(Application $app)
    {
        /** @var UsernamePasswordToken $token */
        $token = $app['security.token_storage']->getToken();

        if (!$token instanceof UsernamePasswordToken) {
            return null;
        }

        /** @var User $user */
        $user = $token->getUser();

        if (!$user instanceof User) {
            return null;
        }

        return $user;
    }
}
