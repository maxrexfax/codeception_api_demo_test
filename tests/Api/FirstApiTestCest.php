<?php


namespace Tests\Api;

use Tests\Support\ApiTester;
use CustomCore\BaseApi;


class FirstApiTestCest extends BaseApi
{
    public function _before(ApiTester $I, \Codeception\Scenario $scenario)
    {
        parent::_before($I, $scenario);
        $this->scenario = $scenario;
    }

    // tests
    public function testGetListOfDemoUsers(ApiTester $I, \Codeception\Scenario $scenario)
    {
        // $msg = 'Test route "Get List Of Demo Users"';
        // $this->writeStart($msg);
        // $url = $I->getApiHost() . 'http://api.maxbarannyk.ru/demo-user/21';
        $I->writeMessageInsideResultHtml('Start test for demo users api route');
        $url = $I->getApiHost() . 'demo-users';
        $data = [];
        $result = $this->sendGet($I, $url);
        // $response = $I->sendGet($url, $data);
        // $result = json_decode($response, true);
        $structure = $this->miniStructure;        
        $structure['data'] = [
            'total' => 'integer',
            'users' => [
                [
                'id' => 'integer',
                'uuid' => 'string',
                'first_name' => 'string',
                'last_name' => 'string',
                'login' => 'string',
                'email' => 'string',
                'email_confirmed' => 'integer',
                'created_by' => 'string',
                'created_at' => 'string',
                'updated_at' => 'string'
                ]
            ]            
        ];
        // var_dump($structure);
        
        $this->checkResultLight($I, $structure);
        // $this->writeFinish($msg, $I);
    }
}
