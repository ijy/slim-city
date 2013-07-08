<?php
require '../vendor/autoload.php';

// Prepare app
$app = new \Slim\Slim(array(
    'templates.path' => '../templates',
    'log.level' => 4,
    'log.enabled' => true,
    'log.writer' => new \Slim\Extras\Log\DateTimeFileWriter(array(
        'path' => '../logs',
        'name_format' => 'y-m-d'
    ))
));

// Prepare view (with Twig)
\Slim\Extras\Views\Twig::$twigOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('../templates/cache'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);
$app->view(new \Slim\Extras\Views\Twig());


/*
|--------------------------------------------------------------------------
| Define Routes
|--------------------------------------------------------------------------
|
| This is where we define all the routing logic for the application.
|
*/

// Home (with optional city parameter)
$app->get('/:city', function($city) use ($app) {
    $app->render('index.twig.html', array(
        'city' => $city,
    ));
});


// Run app
$app->run();
