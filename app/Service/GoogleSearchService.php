<?php

namespace App\Service;

use App\Factories\GoogleClientFactoryInterface;
use Google_Service_Customsearch;

/*
 * Connects to Google and returns an array of results
 */
class GoogleSearchService implements SearchServiceInterface
{
    const RESULTS_PER_REQUEST = 10;
    const MAX_RESULTS_LIMIT = 100;

    /** @var Google_Service_Customsearch $googleServiceCustomSearch */
    protected $googleServiceCustomSearch;

    /** @var array $options */
    protected $options = [];

    public function __construct(GoogleClientFactoryInterface $factory)
    {
        $this->googleServiceCustomSearch = $factory->getService();
        $this->options = $factory->getBaseParams();
    }

    /**
     * @param string $searchString
     * @return array
     */
    public function search(string $searchString)
    {
       /** @var \Google_Service_Customsearch_Search[] $searchResults */
       $searchResults = [];
       $params = array_merge($this->options, [
           'q' => $searchString,
           'num' => self::RESULTS_PER_REQUEST
       ]);

       $attempts = ceil(self::MAX_RESULTS_LIMIT/self::RESULTS_PER_REQUEST);
       try {
           //Google returns only 10 results per search.
           for ($i = 0; $i < $attempts; $i++) {
               $params['start'] = (self::RESULTS_PER_REQUEST * $i) + 1;
               $result = $this->googleServiceCustomSearch->cse->listCse($params);
               foreach ($result->getItems() as $record) {
                   $searchResults[] = $record;
               }
           }

           return $searchResults;
       } catch (\Exception $e) {
           print 'Exception : ' . $e->getMessage() . '\n';
       }
    }

    /**
     * @param string $searchString
     * @return array
     */
    public function getLinksFromSearch(string $searchString)
    {
        $results = $this->search($searchString);

        return array_map(function($record) {
           return ['link' => $record->getHtmlFormattedUrl(), 'display_link' => $record->getDisplayLink()];
        }, $results);
    }
}