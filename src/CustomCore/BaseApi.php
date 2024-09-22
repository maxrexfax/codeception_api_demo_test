<?php

namespace CustomCore;

use Codeception\Exception\CofigurationException;
use Codeception\Scenario;
use Tests\Support\ApiTester;
use Tests\Support\Helper\Api;

class BaseApi
{
    protected array $miniStructure = [
        'result' => [
            'status' => 'integer'
        ],
        'data' => [

        ]
    ];

    public function _before(ApiTester $I, \Codeception\Scenario $scenario)
    {
        
    }

    /**
     * Set headers before sending request
     * @param ApiTester $I
     * @return void
     */
    protected function setHeaders(ApiTester $I): void
    {
        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('content-type', 'application/json');
    }

    /**
     * Send put request to create item
     * @param ApiTester $I
     * @param $path
     * @param $data
     * @param $secured
     * @return mixed
     */
    protected function sendPut(ApiTester $I, $path, $data = [], $secured = true)
    {
        $response = $I->sendPut($path, json_encode($data));
        return json_decode($response, true);
    }

    /**
     * Send GET request (usually to get list of items)
     * @param ApiTester $I
     * @param $path
     * @param $data
     * @param $secured
     * @return mixed
     */
    protected function sendGet(ApiTester $I, $path, $data = [], $secured = true)
    {
        $this->setHeaders($I);
        $response = $I->sendGet($path, $data);
        return json_decode($response, true);
    }

    /**
     * Send POST request to edit item
     * @param ApiTester $I
     * @param $path
     * @param $data
     * @param $secured
     * @return mixed
     */
    protected function sendPost(ApiTester $I, $path, $data = [], $secured = true)
    {
        $this->setHeaders($I);
        $response = $I->sendPost($path, json_encode($data));
        return json_decode($response, true);
    }

    /**
     * Send DELETE request to delete item
     * @param ApiTester $I
     * @param $path
     * @param $secured
     * @return mixed
     */
    protected function sendDel(ApiTester $I, $path, $secured = true)
    {
        $response = $I->sendDelete($path);
        return json_decode($response, true);
    }    

    /**
     * Is used for custom list checks
     * @param ApiTester $I
     * @param $structure
     * @param int $status
     * @return void
     */
    protected function checkResultLight(ApiTester $I, $structure, int $status = 200)
    {
        $I->seeResponseContainsJson();
        $I->seeResponseCodeIs($status);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType($structure);
    }
}