<?php

   namespace Controllers;

   use Silex\Application;
   use Silex\ControllerCollection;

   class PageController extends AbstractAppController
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
         // creates a new controller based on the default route
         $controllers = $app['controllers_factory'];

         $controllers->get('/', function (Application $app) {
            return $app['twig']->render("index.html", array('title' => 'Cristi'));
         });
         $controllers->get('/addOrEdit', function (Application $app) {
            return $app['twig']->render("index.html", array(
                     'pageContent' => $app['twig']->render("add-edit-auction.html", [])
            ));
         });

         return $controllers;
      }


      /**
       * TODO get data from Model, send it to the view and display
       */
      protected function getPageContent()
      {
         // read data
         // send to view
         // display view
      }
   }