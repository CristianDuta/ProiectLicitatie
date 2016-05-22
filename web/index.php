<?php

use BusinessLogic\UserProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Controllers\PageController;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['config'] = include "../app/config/global.config.php";
$app['local_config'] = include "../app/config/local.config.php";



/** register auth services */
$app->register(new SessionServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'default' => array(
            'pattern' => '^/.*$',
            'anonymous' => true, // Needed as the login path is under the secured area
            'form' => array('login_path' => '/', 'check_path' => 'login_check'),
            'logout' => array('logout_path' => '/logout'), // url to call for logging out
            'users' => $app->share(function() use ($app) {
                return new UserProvider();
            }),
        ),
    ),
    'security.access_rules' => array(
        array('^/view$', 'ROLE_USER'),
        array('^/viewDetails/.*$', 'ROLE_USER'),
        array('^/addOrEdit.*$', 'ROLE_ADMIN'),
    )
));



/** register swiftmailer */
$app->register(new SwiftmailerServiceProvider());
$app['swiftmailer.options'] = $app['local_config']['mail'];



/** register twig  */
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../web/Resources/views',
//            'twig.options' => array('cache' => __DIR__.'/../cache'),
    'twig.options' => array(
        'cache' => false,
    ),
));


$app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig, $app) {
    $twig->addFunction(new Twig_SimpleFunction('asset', function ($asset) {
        return sprintf('/web/assets/%s', ltrim($asset, '/'));
    }));
    return $twig;
}));



$app->mount('/', new PageController());
$app->run();
