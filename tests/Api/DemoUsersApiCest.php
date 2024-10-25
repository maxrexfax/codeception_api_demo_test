<?php


namespace Tests\Api;

use Tests\Support\ApiTester;
use CustomCore\BaseApi;

class DemoUsersApiCest extends BaseApi
{
    protected array $userFields = [
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
    ];
    public function _before(ApiTester $I, \Codeception\Scenario $scenario)
    {
        parent::_before($I, $scenario);
        $this->scenario = $scenario;
    }

    tests
    public function testGetListOfDemoUsers(ApiTester $I, \Codeception\Scenario $scenario)
    {
        $msg = 'Test route "Get List Of Demo Users"';
        $this->writeStart($msg);
        $I->writeMessageInsideResultHtml('Start test for demo users api route');
        $url = $I->getApiHost() . 'demo-users';
        $data = [];
        $result = $this->sendGet($I, $url);
        $structure = $this->miniStructure;        
        $structure['data'] = [ 
            $this->userFields 
        ];      
        $structure['info'] = [
            'total' => 'integer',
        ];
        
        $this->checkResultLight($I, $structure);
        $this->writeFinish($msg, $I);
    }

    public function testCreateDemoUser(ApiTester $I, \Codeception\Scenario $scenario)
    {
        $msg = 'Test route "Creation of Demo User"';
        $this->writeStart($msg);
        $errorMessage = '';
        $isErrorFound = false;
        $createdUserId = null;
        $structure = $this->miniStructure;
        $structure['data'] = [ $this->userFields ]; 
        $url = $I->getApiHost() . 'demo-users';
        $firstName = 'First Name' . time();
        $login = 'login_' . time();
        $email = 'email' . time() . '@mail.com';
        $data = [
            'first_name'=> $firstName,
            'last_name'=> 'Last Name',
            'login'=> $login,
            'email'=> $email,
            'password'=> '12345678',
            'non_required_name_1'=> 'Some text data',
        ];
        var_dump('testCreateDemoUser   $url:', $url, '$data:', $data);
        try {
            $result = $this->sendPost($I, $url, $data);
            var_dump($result);
            exit('FILE:' . __FILE__ . '  CLASS:' . __CLASS__ . '  LINE:' . __LINE__);
            $this->checkResultLight($I, $structure);
            foreach($data as $fieldName => $fieldValue) {
                $I->seeRespnseContainsJson([$fieldName => $fieldValue]);
            }
        } catch (Exception $ex) {
            $isErrorFound = true;
            $errorMessage = $ex->getMessage();
        } finally {
            if (!empty($createdUserId)) {
                $deleteUrl = $I->getApiHost() . 'demo-users' . $createdUserId;
                $this->sendDel($I, $deleteUrl);
            } else {
                $I->writeMessageInsideResultHtml('Created user ID is empty - nothing to delete from DB');
            }
        }
        if ($isErrorFound) {
            $I->fail($errorMessage);
        }
        
        $this->writeFinish($msg, $I);
    }

    /**
     * @skip
     */
    public function testEditDemoUser(ApiTester $I, \Codeception\Scenario $scenario)
    {

    }


    /**
     * @skip
     */
    public function testDeleteDemoUser(ApiTester $I, \Codeception\Scenario $scenario)
    {

    }
}
