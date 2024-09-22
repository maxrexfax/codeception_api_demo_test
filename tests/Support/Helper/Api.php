<?php
declare(strict_types=1);

namespace Tests\Support\Helper;


use Codeception\Configuration;
use Codeception\Exception\ConfigurationException;
use Tests\Support\ApiTester;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Api extends \Codeception\Module
{
    public function getApiHost()
    {
        return Configuration::config()['api_url'];
    }

    public function writeMessageInsideResultHtml(string $message) {}
}