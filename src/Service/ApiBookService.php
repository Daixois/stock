<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;

use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class ApiBookService
{

    private $client;

	public function __construct(HttpClientInterface $client)
	{
		$this->client = $client;
		// $this->language = "&language=fr-FR";
        // Avec langue en français
		// $this->apiKey = "?api_key=AIzaSyAFgIQBL-nPuBCfZhEGi8V7S_CSLG45owg" . $this->language ;
        // sans specificité langue
        $this->apiKey = "?api_key=AIzaSyAFgIQBL-nPuBCfZhEGi8V7S_CSLG45owg";
	}

    private function getApi(string $var)
    {
        $response = $this->client->request(
            'GET',
            // Recherche exemple.
            'https://www.googleapis.com/books/v1/' . $var
        );

        return $response->toArray();
    }
	
	public function searchBookApi(string $var) 
	{
		return $this->getApi( $this->apiKey . "volumes?q=" . $var); 
	}

}