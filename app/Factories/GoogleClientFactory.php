<?php

namespace App\Factories;

use Google_Client;
use Google_Service_Customsearch;

class GoogleClientFactory implements GoogleClientFactoryInterface
{

    protected $service;

    protected $baseParams;

    /**
     * GoogleClientFactory constructor.
     */
    public function __construct($appName = 'GoogleKeywordsSearch')
    {
        $this->baseParams = ["cx"=>$_ENV['GCSE_SEARCH_ENGINE_ID']];

        /** @var Google_Client $client */
        $client = new Google_Client();

        $client->setApplicationName($appName);
        $client->setDeveloperKey($_ENV['GCSE_API_KEY']);

        /** @var Google_Service_Customsearch $service */
        $this->service = new Google_Service_Customsearch($client);
    }

    /**
     * @return Google_Service_Customsearch
     */
    public function getService(): Google_Service_Customsearch
    {
        return $this->service;
    }

    /**
     * @return array
     */
    public function getBaseParams(): array
    {
        return $this->baseParams;
    }
}