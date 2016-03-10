<?php

   use Silex\Provider\TwigServiceProvider;

   require_once __DIR__ . '/../vendor/autoload.php';

   $app = new Silex\Application();

   $app->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__.'/../web/Resources/views',
//            'twig.options' => array('cache' => __DIR__.'/../cache'),
            'twig.options' => array('cache' => false),
   ));

   $app['config'] = include "../app/config/global.config.php";

   $app['twig'] = $app->share($app->extend('twig', function(\Twig_Environment $twig, $app) {
      $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) {
         return sprintf('/web/assets/%s', ltrim($asset, '/'));
      }));
      return $twig;
   }));

   $app->mount('/', new Controllers\PageController());
   $app->run();