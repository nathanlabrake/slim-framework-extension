<?php
use \Slim\Views\Twig as Twig;
use \Slim\Http\Uri as Uri;
use \Slim\Http\Environment as Environment;
use \Slim\Views\TwigExtension as TwigExtension;
use \Includes\Classes\Extensions\TwigAssets as TwigAssets;

/**
 * Autoload the classes
 */
function autoload( $class ) {

    $classPath = explode('\\', $class);

    $namespace = '';

    foreach( $classPath as $path ) {

        if( $path !== end( $classPath ) ) {

            $namespace .= $path . '\\';

        }
    }

    $namespace = strtolower( $namespace );
    $class = end( $classPath );
    $fullClassPath = __DIR__ . '/' . $namespace . $class . '.php';

    include $fullClassPath;
}

spl_autoload_register( __NAMESPACE__ . '\autoload');

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

// Fetch DI Container
$container = $app->getContainer();

// Register Twig View helper
$container['view'] = function ($c) {
    $view = new Twig('views');
    
    // Instantiate and add Slim specific extension
    $router = $c->get('router');
    $uri = Uri::createFromEnvironment(new Environment($_SERVER));
    $view->addExtension(new TwigExtension($router, $uri));
    $view->addExtension(new TwigAssets($router, $uri));

    return $view;
};

require __DIR__ . '/includes/middleware.php';
require __DIR__ . '/includes/routes.php';

$app->run();

