<?php

namespace App\Test\Service;

use App\Service\GoogleSearchService;
use App\Factories\GoogleClientFactory;

use Google_Service_Customsearch_Result;
use PHPUnit\Framework\TestCase;

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
        $arrayDiff = array_diff($expectedArray, $response);

        $this->assertEquals(0, count($arrayDiff));
    }
}
