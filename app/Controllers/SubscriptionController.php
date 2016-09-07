<?php

namespace Controllers;

use Database\Model\Subscription;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;

class SubscriptionController extends AbstractAppController
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

        $this->setUpSaveSubscription();

        return $this->getControllerCollection();
    }



    private function setUpSaveSubscription()
    {
        $this->getControllerCollection()->post('/save', function (Application $app, Request $request) {
            $subscription = new Subscription();
            $subscription->setCompanyName($request->get('companyName'));
            $subscription->setCompanyAddress($request->get('companyAddress'));
            $subscription->setCompanyCui($request->get('companyCui'));
            $subscription->setCompanyRepresentative($request->get('companyRepresentative'));
            $subscription->setIbanAccount($request->get('companyIban'));
            $subscription->setEmailAddress($request->get('email'));
            $subscription->setPhoneNumber($request->get('phoneNumber'));
            $subscription->save();

            return $app->redirect('/home');
        });
    }
}