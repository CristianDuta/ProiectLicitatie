<?php

namespace Controllers;

use BusinessLogic\UserProvider;
use BusinessLogic\UserRegistrationProcess;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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
                $parameterList['phoneNumber']
            );
            $userRegistrationProcess->execute();
            $this->loginUser($app, $parameterList);
            return $app->redirect('/home');
        });
    }

    private function loginUser(Application $app, $loginData)
    {
        $userProvided = new UserProvider();
        $User = $userProvided->loadUserByUsername($loginData['email']);
        $token = new UsernamePasswordToken($User, $User->getPassword(), 'default', array('ROLE_USER'));

        $app['security.token_storage']->setToken($token);
    }
}
