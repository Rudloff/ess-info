<?php
require_once 'vendor/autoload.php';


$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Smarty()
));
$view = $app->view();
$view->parserExtensions = array(
    __DIR__.'/vendor/slim/views/SmartyPlugins',
    __DIR__.'/vendor/rudloff/smarty-plugin-noscheme/'
);
$app->get('/', array('ESSInfo\Controller\FrontController', 'index'))->name('index');
$app->get('/search/', function () use ($app) {
    $app->redirect($app->urlFor('index'));
});
$app->post('/search/', array('ESSInfo\Controller\FrontController', 'searchResults'))->name('searchResults');
$app->get('/company/:siret', array('ESSInfo\Controller\FrontController', 'company'))->name('company');
$app->run();
