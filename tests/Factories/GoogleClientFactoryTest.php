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
    protected $factory;

    public function setUp()
    {
        parent::setUp();
        $this->factory = new GoogleClientFactory();
    }

    public function testServiceAttributeIsGoogleService()
    {
        $this->assertAttributeInstanceOf(Google_Service_Customsearch::class, 'service', $this->factory);
    }
}
