<?php

use BusinessLogic\UserProvider;
use Knp\Provider\ConsoleServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new Silex\Application();
$app['config'] = require_once dirname(__DIR__) . "/app/config/global.config.php";
$app['local_config'] = require_once dirname(__DIR__) . "/app/config/local.config.php";
$app['route_class'] = 'BusinessLogic\SecureRoute';

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
        array('^/auction$', 'ROLE_USER'),
    )
));


/** register swiftmailer */
$app->register(new SwiftmailerServiceProvider());
$app['swiftmailer.options'] = $app['local_config']['mail'];


/** register twig  */
$app->register(new TwigServiceProvider(), array(
    'twig.path' => array(
        __DIR__.'/../web/views/admin',
        __DIR__.'/../web/views/user',
    ),
    'twig.options' => array(
        'cache' => false,
    ),
));
$app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig) {
    $twig->addFunction(new Twig_SimpleFunction('asset', function ($asset) {
        return sprintf('/web/assets/%s', ltrim($asset, '/'));
    }));
    return $twig;
}));


$app->register(
    new ConsoleServiceProvider(),
    array(
        'console.name' => 'ConsoleApp',
        'console.version' => '1.0',
        'console.project_directory' => $app['local_config']['root_path']
    )
);


return $app;
