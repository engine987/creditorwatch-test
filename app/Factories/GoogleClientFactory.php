<?php

namespace App\Factories;

use Google_Client;
use Google_Service_Customsearch;

class GoogleClientFactory implements GoogleClientFactoryInterface
{

    const GCSE_API_KEY = "AIzaSyCcWgAanyRm1CkYE8De44xeXD8b6lAjHIY";
    const GCSE_SEARCH_ENGINE_ID = "e17ee70ab87bd903c";

    protected $service;

    protected $baseParams;

    /**
     * GoogleClientFactory constructor.
     */
    public function __construct($appName = 'GoogleKeywordsSearch')
    {
        $this->baseParams = ["cx"=>self::GCSE_SEARCH_ENGINE_ID];

        /** @var Google_Client $client */
        $client = new Google_Client();

        $client->setApplicationName($appName);
        $client->setDeveloperKey(self::GCSE_API_KEY);

        /** @var Google_Service_Customsearch $service */
        $this->service = new Google_Service_Customsearch($client);
    }

    public static function getCustomSearch()
    {
        return new self();
    }

    /**
     * @return Google_Service_Customsearch
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @return array
     */
    public function getBaseParams()
    {
        return $this->baseParams;
    }
}