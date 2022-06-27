<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\Country;

$currency = new Country();

class LoadCountries extends PHPUnit_Framework_TestCase {
    
    private $http;
    public function setUp()
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'http://localhost/phpcsv/']);
    }

    public function tearDown() {
        $this->http = null;
    }

    public function testLoadCountries() {
        $response = $this->http->request('GET', 'api/loadcountrycsv');
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("text/html; charset=UTF-8", $contentType);  
    }

    
 
}


?>