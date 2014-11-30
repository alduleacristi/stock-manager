<?php

namespace Main\StockManagerBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoutingControllerTest extends WebTestCase {
	public function testIndex() {
		$client = static::createClient ();
		
		$crawler = $client->request ( 'GET', '/index' );
		
		$this->assertTrue ( $crawler->filter ( 'html:contains("Welcome to StockManager")' )->count () > 0 );
	}
	public function testAllProducts() {
		$client = static::createClient ();
		
		$crawler = $client->request ( 'GET', 'view/products' );
		
		$this->assertTrue ( $crawler->filter ( 'html:contains("Detergent")' )->count () > 0 );
	}
}

?>