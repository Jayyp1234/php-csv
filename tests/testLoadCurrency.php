<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Model\Currency;

$curency = new Currency();

class LoadCurrency extends PHPUnit_Framework_TestCase {
    
    private $http;
    public function setUp()
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'http://localhost/phpcsv/']);
    }

    public function tearDown() {
        $this->http = null;
    }

    public function testLoadCurrency() {
        $response = $this->http->request('GET', 'api/loadcurrencycsv');
        $this->assertEquals(200, $response->getStatusCode());
        
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("text/html; charset=UTF-8", $contentType);  
    }

    
 
}


?>