<?php

use Slim\App;
use Slim\Views\Smarty;
use ESSInfo\Controller\FrontController;

require_once 'vendor/autoload.php';

$app = new App();
$container = $app->getContainer();
$container['view'] = function ($c) {
    $view = new Smarty(__DIR__.'/templates/');

    $view->addSlimPlugins($c['router'], $c['request']->getUri());

    return $view;
};
$app->get('/', [FrontController::class, 'index'])->setName('index');
$app->get('/search/', [FrontController::class, 'searchResults'])->setName('searchResults');
$app->get('/company/{siret}', [FrontController::class, 'company'])->setName('company');
$app->run();
