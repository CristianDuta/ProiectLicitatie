<?php

namespace Controllers;

use BusinessLogic\PageRenderSettingsFactory;
use Silex\Application;
use Silex\ControllerCollection;

class WebPageController extends AbstractAppController
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

        $this->setUpGeneralRoute();

        return $this->getControllerCollection();
    }


    /**
     * Setup general access route
     */
    private function setUpGeneralRoute()
    {
        $this->getControllerCollection()->get('/{pageName}/{pageValue}', function (Application $app, $pageName, $pageValue) {

            $templateName = 'home-page.html';
            if ($pageName) {
                $templateName = $pageName . '-page.html';
            }

            $renderParams             = $this->getPageRenderParams($app, $pageName, $pageValue);
            $renderParams['pageName'] = $templateName;
            $renderParams['username'] = $this->getUser($app);

            return $app['twig']->render("index.html", $renderParams);
        })->value('pageName', '')->value('pageValue', '');
    }


    /**
     * @param Application $app
     * @param string $pageName
     * @param string $pageValue
     * @return array
     */
    private function getPageRenderParams(Application $app, $pageName, $pageValue)
    {
        $pageRenderSettingsFactory = new PageRenderSettingsFactory($app);
        $pageRenderSettings        = $pageRenderSettingsFactory->create($pageName, $pageValue);

        $renderParams = array();
        if ($pageRenderSettings) {
            $renderParams = $pageRenderSettings->getRenderParams();
        }
        return $renderParams;
    }
}
