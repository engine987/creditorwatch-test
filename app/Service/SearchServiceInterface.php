<?php
/**
 *  * Created by PhpStorm.
 * User: Krishna Rao
 * Date: 2020-09-08
 * Time: 13:21
 */

namespace App\Service;


interface SearchServiceInterface
{
    public function search(string $searchString);
    public function getLinksFromSearch(string $searchString);
}