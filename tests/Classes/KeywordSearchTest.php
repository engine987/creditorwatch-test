<?php
/**
 *  * Created by PhpStorm.
 * User: Krishna Rao
 * Date: 2020-09-08
 * Time: 19:03
 */

namespace App\Test\Classes;

use App\Classes\KeywordSearch;
use App\Service\SearchServiceInterface;
use PHPUnit\Framework\TestCase;

class KeywordSearchTest extends TestCase
{
    public function testParseResultsForWebsite()
    {
        $service = $this->createMock(SearchServiceInterface::class);

        $expectedArray = [
            ['link' => 'www.creditorwatch.com.au', 'display_link' => 'www.creditorwatch.com.au'],
            ['link' => 'www.veda.com.au', 'display_link' => 'www.veda.com.au'],
            ['link' => 'www.dunnandbradstreet.com.au', 'display_link' => 'www.dunnandbradstreet.com.au'],
            ['link' => 'www.experian.com.au', 'display_link' => 'www.experian.com.au'],
        ];

        $service->expects($this->once())
            ->method('getLinksFromSearch')
            ->willReturn($expectedArray);

        $keyWordSearch = new KeywordSearch($service);
        $position = $keyWordSearch->parseResultsForWebsite('Credit Checks', 'www.creditorwatch.com.au');

        $this->assertEquals('1', $position[0]);
    }
}
