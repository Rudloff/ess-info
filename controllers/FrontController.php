<?php

namespace ESSInfo\Controller;

use InfogreffeUnofficial\Infogreffe;
use Symfony\Component\Yaml\Yaml;

class FrontController
{
    public static function index($request, $response)
    {
        global $container;
        $container->view->render(
            $response,
            'index.tpl',
            [
                'description' => "Ce site vous permet de recherche un organisme et d'obtenir des informations concernant sa forme juridique.",
            ]
        );
    }

    public static function searchResults($request, $response)
    {
        global $container;
        $query = $request->getParam('query');
        if (!empty($query)) {
            $results = Infogreffe::search($query);
            $container->view->render(
                $response,
                'searchResults.tpl',
                [
                    'results'     => $results,
                    'query'       => $query,
                    'title'       => 'Résultats de la recherche «&nbsp;'.$query.'&nbsp;»',
                    'description' => 'Résultats de la recherche «&nbsp;'.$query.'&nbsp;» sur ESS info',
                ]
            );
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
            $response->getBody()->write('Numéro SIRET introuvable');
            return $response->withStatus(404);
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
        $description = 'Informations sur '.$results[0]->name;
        if ($categoryName != 'Forme juridique inconnue') {
            $description .= ', '.$categoryName;
        }
        $container->view->render(
            $response,
            'company.tpl',
            [
                'info'        => $results[0],
                'types'       => $types,
                'category'    => $categoryName,
                'activity'    => $activityName,
                'url'         => $results[0]->getURL(),
                'title'       => $results[0]->name,
                'description' => $description,
            ]
        );
    }

    public static function toHome($request, $response)
    {
        global $container;

        return $response->withHeader('Location', $container->router->pathFor('index'));
    }
}
