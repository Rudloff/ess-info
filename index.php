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
$app->get('/', array('ESSInfo\Controller\FrontController', 'index'))->setName('index');
$app->get('/search/', function () use ($app) {
    $app->redirect($app->urlFor('index'));
});
$app->post('/search/', array('ESSInfo\Controller\FrontController', 'searchResults'))->setName('searchResults');
$app->get('/company/{siret}', array('ESSInfo\Controller\FrontController', 'company'))->setName('company');
$app->run();
