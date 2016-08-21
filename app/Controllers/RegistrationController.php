<?php

namespace Controllers;

use BusinessLogic\UserRegistrationProcess;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\User;

class RegistrationController extends AbstractAppController
{
    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $this->setControllerCollection($app['controllers_factory']);

        $this->setUpUserRegistration();

        return $this->getControllerCollection();
    }

    private function setUpUserRegistration()
    {
        $this->getControllerCollection()->post('/register', function (Application $app, Request $request) {
            $parameterList           = $request->request->all();
            $userRegistrationProcess = new UserRegistrationProcess(
                $parameterList['email'],
                $app['security.encoder.digest']->encodePassword($parameterList['password'], ''),
                $parameterList['firstName'],
                $parameterList['lastName'],
                $parameterList['phoneNumber'],
                $parameterList['newsOption']
            );
            $userRegistrationProcess->execute();

            return $app->redirect('/');
        });
    }

    private function loginUser(Application $app, $loginData)
    {
        $User = new User($loginData['email'], $loginData['password'], array('ROLE_USER'));
        $app['security']->setToken(serialize(new UsernamePasswordToken($User, $User->getPassword(), 'default', array('ROLE_USER'))));
    }
}
