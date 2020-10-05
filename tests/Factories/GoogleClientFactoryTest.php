<?php
/**
 *  * Created by PhpStorm.
 * User: Krishna Rao
 * Date: 2020-09-08
 * Time: 15:58
 */

namespace App\Test\Factories;

use App\Factories\GoogleClientFactory;

use Google_Service_Customsearch;
use PHPUnit\Framework\TestCase;

class GoogleClientFactoryTest extends TestCase
{
    const GCSE_API_KEY = "AIzaSyCcWgAanyRm1CkYE8De44xeXD8b6lAjHIY";
    const GCSE_SEARCH_ENGINE_ID = "e17ee70ab87bd903c";

    protected $factory;

    public function setUp()
    {
        parent::setUp();
        $this->factory = GoogleClientFactory::getCustomSearch();
    }

    public function testGetCustomSearchReturnsFactory()
    {
        $this->assertInstanceOf(GoogleClientFactory::class, $this->factory);
    }

    public function testServiceAttributeIsGoogleService()
    {
        $this->assertAttributeInstanceOf(Google_Service_Customsearch::class, 'service', $this->factory);
    }
}
