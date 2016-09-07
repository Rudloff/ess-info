<?php

require_once 'vendor/autoload.php';

$app = new \Slim\App();
$container = $app->getContainer();
$container['view'] = function ($c) {
    $view = new \Slim\Views\Smarty(__DIR__.'/templates/');

    $view->addSlimPlugins($c['router'], $c['request']->getUri());
    $view->registerPlugin('modifier', 'noscheme', 'Smarty_Modifier_noscheme');

    return $view;
};
$app->get('/', ['ESSInfo\Controller\FrontController', 'index'])->setName('index');
$app->get('/search/', ['ESSInfo\Controller\FrontController', 'searchResults'])->setName('searchResults');
$app->get('/company/{siret}', ['ESSInfo\Controller\FrontController', 'company'])->setName('company');
$app->run();
