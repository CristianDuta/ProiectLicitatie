<?php

use BusinessLogic\UserProvider;
use Silex\Provider\RoutingServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new Silex\Application();
$app['config'] = require_once dirname(__DIR__) . "/app/config/global.config.php";
$app['local_config'] = require_once dirname(__DIR__) . "/app/config/local.config.php";
$app['debug'] = true;


/** register auth services */
$app->register(new SessionServiceProvider());
$app->register(new RoutingServiceProvider());
$app->register(new SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'default' => array(
            'pattern' => '^/.*$',
            'anonymous' => true, // Needed as the login path is under the secured area
            'form' => array(
                'login_path' => '/auth',
                'check_path' => 'login_check',
                'always_use_default_target_path' => true,
                'default_target_path' => '/login/redirect'
            ),
            'logout' => array(
                'logout_path' => '/logout',
                'invalidate_session' => true
            ),
            'users' => $app->factory(function() use ($app) {
                return new UserProvider();
            }),
        ),
    ),
    'security.access_rules' => array(
        array('^/auction.*$', 'ROLE_USER'),
    ),
    'security.default_encoder' => function ($app) {
        return $app['security.encoder.digest'];
    }
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
$app['twig'] = $app->factory($app->extend('twig', function(Twig_Environment $twig) {
    $twig->addFunction(new Twig_SimpleFunction('asset', function ($asset) {
        return sprintf('/web/assets/%s', ltrim($asset, '/'));
    }));
    return $twig;
}));


$app->register(
    new \Knp\Provider\ConsoleServiceProvider(),
    array(
        'console.name' => 'ConsoleApp',
        'console.version' => '1.0',
        'console.project_directory' => $app['local_config']['root_path']
    )
);

$app['route_class'] = 'BusinessLogic\SecureRoute';

return $app;
