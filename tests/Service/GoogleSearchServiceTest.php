<?php

namespace App\Test\Service;

use App\Service\GoogleSearchService;
use App\Factories\GoogleClientFactory;

use Google_Service_Customsearch_Result;
use Pettibon\AppBundle\Entity\Message\Event;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\once;

class GoogleSearchServiceTest extends TestCase
{
    public function testGetLinksFromSearch()
    {
        $factory = new GoogleClientFactory();

        $searchService = $this->getMockBuilder(GoogleSearchService::class)
            ->setConstructorArgs([$factory])
            ->setMethods(['search'])
            ->getMock();

        $mockedResult = $this->createMock(Google_Service_Customsearch_Result::class);
        $mockedResult->method('getHtmlFormattedUrl')->will(
            $this->onConsecutiveCalls('www.creditorwatch.com.au', 'www.veda.com.au', 'www.dunnandbradstreet.com.au', 'www.experian.com.au')
        );

        $mockedResult->method('getDisplayLink')->will(
            $this->onConsecutiveCalls('www.creditorwatch.com.au', 'www.veda.com.au', 'www.dunnandbradstreet.com.au', 'www.experian.com.au')
        );

        $array = [$mockedResult, $mockedResult, $mockedResult, $mockedResult];
        $searchService->expects($this->once())
            ->method('search')
            ->willReturn($array);

        $expectedArray = [
           ['link' => 'www.creditorwatch.com.au', 'display_link' => 'www.creditorwatch.com.au'],
           ['link' => 'www.veda.com.au', 'display_link' => 'www.veda.com.au'],
           ['link' => 'www.dunnandbradstreet.com.au', 'display_link' => 'www.dunnandbradstreet.com.au'],
           ['link' => 'www.experian.com.au', 'display_link' => 'www.experian.com.au'],
        ];

        $response = $searchService->getLinksFromSearch('Credit Checks');
        for ($i = 0; $i < count($expectedArray); $i++) {
            $this->assertEquals($expectedArray[$i], $response[$i]);
        }
    }

    public function testSearch()
    {
        $factory = new GoogleClientFactory();

        $searchService = $this->getMockBuilder(GoogleSearchService::class)
            ->setConstructorArgs([$factory])
            ->setMethods(['getSearchResults'])
            ->getMock();

        $mockedResult = $this->createMock(Google_Service_Customsearch_Result::class);
        $searchService->expects($this->once())
            ->method('getSearchResults')
            ->willReturn([$mockedResult]);

        $result = $searchService->search('boo');
        $this->assertInstanceOf(Google_Service_Customsearch_Result::class, $result[0]);
    }
}
