<?php
/**
 *  * Created by PhpStorm.
 * User: Krishna Rao
 * Date: 2020-09-08
 * Time: 10:08
 */

namespace App\Factories;


interface GoogleClientFactoryInterface
{
    public function getService();
    public function getBaseParams();
}