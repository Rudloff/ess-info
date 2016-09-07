<?php

require_once 'vendor/autoload.php';

$climate = new League\CLImate\CLImate();

for ($year = 2012; $year <= 2016; $year++) {
    $climate->flank($year);
    file_put_contents(
        __DIR__.'/sitemap-'.$year.'.txt.gz',
        ''
    );
    $json = json_decode(
        file_get_contents(
            __DIR__.'/vendor/infogreffe/entreprises-immatriculees-en-'.$year.'/download'
        )
    );
    if ($gzfile = gzopen(__DIR__.'/sitemap-'.$year.'.txt.gz', 'w')) {
        $progress = $climate->progress()->total(count($json));
        foreach ($json as $i => $company) {
            if (isset($company->fields->siren)) {
                gzwrite(
                    $gzfile,
                    'https://ess.netlib.re/company/'.$company->fields->siren.PHP_EOL
                );
            }
            $progress->current($i);
        }
        gzclose($gzfile);
    }
}
