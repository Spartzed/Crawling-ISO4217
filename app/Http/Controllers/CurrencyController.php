<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Exception;

class CurrencyController extends Controller
{
    public function fetchCurrencyData($code)
    {
        try {
            $client = new Client();
            $response = $client->request('GET', 'https://pt.wikipedia.org/wiki/ISO_4217');
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);

            $tableRows = [];

            $targetCodes = explode(',', $code);
            foreach ($targetCodes as &$target) {
                if (is_string($target)) {
                    $target = strtoupper(trim($target));
                }
            }

            $crawler->filter('table.wikitable')->eq(0)->filter('tbody tr')->each(function (Crawler $row) use (&$tableRows, $targetCodes) {

                if (!$row->filter('td')->count()) {
                    return;
                }
                $rowCode = $row->filter('td')->eq(0)->text();
                $rowNumber = $row->filter('td')->eq(1)->text();

                if (in_array($rowCode, $targetCodes) || in_array($rowNumber, $targetCodes)) {

                    $decimal = $row->filter('td')->eq(2)->text();
                    $currency = $row->filter('td')->eq(3)->text();

                    $locations = $row->filter('td')->eq(4)->filter('a')->each(function (Crawler $locationNode) {
                        $location = $locationNode->text();
                        $icon = '';

                        $flagIconNode = $locationNode->previousAll()->filter('.flagicon');
                        $imgNode = $flagIconNode->filter('img');
                        if ($imgNode->count() > 0) {
                            $icon = $imgNode->attr('src');
                        }
                        return [
                            'location' => $location,
                            'icon' => $icon,
                        ];
                    });

                    $rowData = [
                        'code' => $rowCode,
                        'number' => intval($rowNumber),
                        'decimal' => intval($decimal),
                        'currency' => $currency,
                        'currency_locations' => $locations,
                    ];

                    $tableRows[] = $rowData;
                }
            });

            return response()->json($tableRows, 200);

        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao acessar a página'], 500);
        }
    }
}
