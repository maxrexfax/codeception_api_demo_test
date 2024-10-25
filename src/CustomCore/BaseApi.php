<?php

namespace CustomCore;

use Codeception\Exception\CofigurationException;
use Codeception\Scenario;
use Tests\Support\ApiTester;

class BaseApi
{
    protected ApiTester $I;

    protected array $miniStructure = [
        'result' => [
            'status' => 'integer'
        ],
        'data' => [

        ]
    ];

    public function _before(ApiTester $I, \Codeception\Scenario $scenario)
    {
        $this->I = $I;
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
        $this->setHeaders($I);
        $I->haveHttpHeader('accept', 'application/x-www-form-urlencoded');
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
        // var_dump('BaseApi  LINE:' . __LINE__ . '  json_encode($data):' . json_encode($data) . '   response:' . $response );
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
        $this->setHeaders($I);
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

    protected function writeStart($msg)
    {
        $this->writeData(sprintf('Start %s at: %s', $msg, date('Y-m-d H:i:s')), 'blue');
    }

    protected function writeFinish($msg)
    {
        $this->writeData(sprintf('Test: %s ENDED at: %s', $msg, date('Y-m-d H:i:s')), 'green');
    }

    /**
     * Write message to console and alternative log file
     * @param $message
     * @param $color
     * @param $filePrefix
     * @return void
     */
    protected function writeData($message, $color)
    {
        $this->I->formatPrintLn([$color, 'bold'], $message);
    }
}