<?php

namespace Controllers;

use Silex\Application;
use Silex\ControllerCollection;

class LoginRedirectController extends AbstractAppController
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

        $this->getControllerCollection()->get('/redirect', array($this, 'index'))->bind('login-redirect');

        return $this->getControllerCollection();
    }


    public function index(Application $app)
    {
        if ($app['security.authorization_checker']->isGranted('ROLE_ADMIN')) {
            return $app->redirect("/admin/");
        }

        return $app->redirect("/");
    }
}
