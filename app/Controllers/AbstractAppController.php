<?php

   namespace Controllers;

   use Silex\Application;
   use Silex\ControllerProviderInterface;
   use Twig_Environment;
   use Twig_Loader_Filesystem;

   abstract class AbstractAppController implements ControllerProviderInterface
   {
      /**
       * TODO get data from Model, send it to the view and display
       */
      protected abstract function getPageContent();
   }