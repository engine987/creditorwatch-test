<?php
/**
 *  * Created by PhpStorm.
 * User: Krishna Rao
 * Date: 2020-09-08
 * Time: 15:58
 */

namespace App\Test\Factories;

use App\Factories\GoogleClientFactory;

use PHPUnit\Framework\TestCase;

class GoogleClientFactoryTest extends TestCase
{
    protected $factory;

    public function setUp(): void
    {
        parent::setUp();
        $this->factory = new GoogleClientFactory();
    }

    public function testServiceAttributeIsGoogleService()
    {
        $service = $this->factory->getService();
        $this->assertInstanceOf(\Google_Service_Customsearch::class,  $service);
    }
}
