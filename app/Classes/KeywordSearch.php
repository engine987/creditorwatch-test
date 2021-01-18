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
       $position = [];

       for($i = 0; $i < count($results); $i++){
           if (stripos($results[$i]['link'], $website) !== false || stripos($results[$i]['display_link'], $website) !== false) {
               $position[] = $i+1;
           }
       }

       return $position;
    }
}