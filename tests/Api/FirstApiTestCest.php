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
        $I->writeMessageInsideResultHtml('Start test for demo users api route');
        $url = $I->getApiHost() . 'demo-users';
        $data = [];
        $result = $this->sendGet($I, $url);
        $structure = $this->miniStructure;        
        $structure['data'] = [
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
        ];      
        $structure['info'] = [
            'total' => 'integer',
        ];
        
        $this->checkResultLight($I, $structure);
        // $this->writeFinish($msg, $I);
    }
}
