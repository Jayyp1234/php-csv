<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\Country;
 
class Countries extends PHPUnit_Framework_TestCase {
    
    private $http;
    public function setUp()
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'http://localhost/phpcsv/']);
    }

    public function tearDown() {
        $this->http = null;
    }

    public function testFind() {
        $response = $this->http->request('GET', 'api/countries');
        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("text/html; charset=UTF-8", $contentType);


        $data = json_decode($response->getBody(), true);

        $this->assertEquals("success", $data['status']);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('currency_code', $data['data'][0]);
        $this->assertArrayHasKey('iso_numeric_code', $data['data'][0]);
        $this->assertArrayHasKey('common_name', $data['data'][0]);
        $this->assertArrayHasKey('official_name', $data['data'][0]);
        $this->assertArrayHasKey('demonym', $data['data'][0]);
    }

    
 
}


?>