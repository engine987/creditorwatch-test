<?php
/**
 *  * Created by PhpStorm.
 * User: Krishna Rao
 * Date: 2020-09-08
 * Time: 13:16
 */

namespace App\Classes;


use App\Service\SearchServiceInterface;

class KeywordSearch
{
    protected $service;

    public function __construct(SearchServiceInterface $service)
    {
        $this->service = $service;
    }

    public function parseResultsForWebsite(string $keyWords, string $website)
    {
       $results = $this->service->getLinksFromSearch($keyWords);
       $count = 0;


       foreach ($results as $result) {
           if (stripos($result['link'], $website) !== false || stripos($result['display_link'], $website) !== false) {
               $count++;
           }
       }

       return $count;
    }
}