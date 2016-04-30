<?php
namespace ESSInfo\Controller;
use InfogreffeUnofficial\Infogreffe;
use Browser\Casper;
use Symfony\Component\Yaml\Yaml;

class FrontController {

    static function index($request, $response) {
        global $container;
        $container->view->render($response, 'index.tpl');
    }

    static function searchResults($request, $response) {
        global $container;
        if (!empty($_POST['query'])) {
            $results = Infogreffe::search($_POST['query']);
            $container->view->render($response, 'searchResults.tpl', array('results'=>$results));
        } else {
            $app->redirect($app->urlFor('index'));
        }
    }

    static function company($request, $response, $params) {
        global $container;
        $types = Yaml::parse(file_get_contents(__DIR__.'/../types.yml'));
        $results = Infogreffe::search($params['siret']);
        $client = new \Goutte\Client();
        $crawler = $client->request('GET', $results[0]->getURL());
        $category = $crawler->filter('.first .identTitreValeur p:nth-of-type(5) .data');
        if ($category->count() == 0) {
            $category = $crawler->filter('[datapath="entreprise.personneMorale.identification.formeJuridique.libelle"] p');
        }
        $activity = $crawler->filter('.first .identTitreValeur p:nth-of-type(6) .data');
        if ($activity->count() == 0) {
            $activity = $crawler->filter('[datapath="activite.codeNAF"] p:first-of-type a');
        }
        $container->view->render(
            $response,
            'company.tpl',
            array(
                'info'=>$results[0],
                'types'=>$types,
                'category'=>trim($category->text()),
                'activity'=>trim($activity->text())
            )
        );
    }
}
