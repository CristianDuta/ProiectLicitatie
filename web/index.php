<?php

   use Silex\Provider\TwigServiceProvider;

   require_once __DIR__ . '/../vendor/autoload.php';

   $app = new Silex\Application();
   $app['config'] = include "../app/config/global.config.php";
   $app['local_config'] = include "../app/config/local.config.php";

   /** register swiftmailer */
   $app->register(new Silex\Provider\SwiftmailerServiceProvider());
   $app['swiftmailer.options'] = $app['local_config']['mail'];

   /** register twig  */
   $app->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__.'/../web/Resources/views',
//            'twig.options' => array('cache' => __DIR__.'/../cache'),
            'twig.options' => array('cache' => false),
   ));

   $app['twig'] = $app->share($app->extend('twig', function(\Twig_Environment $twig, $app) {
      $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) {
         return sprintf('/web/assets/%s', ltrim($asset, '/'));
      }));
      return $twig;
   }));

   /** define controllers */
   $app->mount('/', new Controllers\PageController());
   $app->run();