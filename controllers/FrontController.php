<?php
namespace ESSInfo\Controller;

use InfogreffeUnofficial\Infogreffe;
use Symfony\Component\Yaml\Yaml;

class FrontController
{

    public static function index($request, $response)
    {
        global $container;
        $container->view->render($response, 'index.tpl');
    }

    public static function searchResults($request, $response)
    {
        global $container;
        $query = $request->getParam('query');
        if (!empty($query)) {
            $results = Infogreffe::search($query);
            $container->view->render($response, 'searchResults.tpl', array('results'=>$results));
        } else {
            return self::toHome($request, $response);
        }
    }

    public static function company($request, $response, $params)
    {
        global $container;
        $types = Yaml::parse(file_get_contents(__DIR__.'/../types.yml'));
        $results = Infogreffe::search($params['siret']);
        $client = new \Goutte\Client();
        if (empty($results)) {
            throw(new \Exception('Numéro SIRET introuvable'));
        }
        $crawler = $client->request('GET', $results[0]->getURL());
        $category = $crawler->filter('.first .identTitreValeur p:nth-of-type(5) .data');
        if ($category->count() == 0) {
            $category = $crawler->filter(
                '[datapath="entreprise.personneMorale.identification.formeJuridique.libelle"] p'
            );
        }
        $activity = $crawler->filter('.first .identTitreValeur p:nth-of-type(6) .data');
        if ($activity->count() == 0) {
            $activity = $crawler->filter('[datapath="activite.codeNAF"] p:first-of-type a');
        }
        if (count($category) > 0) {
            $categoryName = trim($category->text());
        } else {
            $categoryName = 'Forme juridique inconnue';
        }
        if ($categoryName == 'null') {
            $categoryName = 'Forme juridique inconnue';
        }
        if (count($activity) > 0) {
            $activityName = trim($activity->text());
        } else {
            $activityName = 'Inconnue';
        }
        if ($activityName == 'null') {
            $activityName = 'Inconnue';
        }
        $container->view->render(
            $response,
            'company.tpl',
            array(
                'info'=>$results[0],
                'types'=>$types,
                'category'=>$categoryName,
                'activity'=>$activityName,
                'url'=>$results[0]->getURL()
            )
        );
    }

    public static function toHome($request, $response)
    {
        global $container;
        return $response->withHeader('Location', $container->router->pathFor('index'));
    }
}
