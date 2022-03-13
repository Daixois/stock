<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;

use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class ApiGoogleBooksService
{
	private $client;

	public function __construct(HttpClientInterface $client)
	{
		$this->client = $client;
		$this->language = "&language=fr-FR";
		$this->apiKey = "?api_key=AIzaSyAFgIQBL-nPuBCfZhEGi8V7S_CSLG45owg" . $this->language ;
	}

	public function getApi(string $var)
	{
		$response = $this->client->request(
			'GET',
			'https://www.googleapis.com/books/v1/volumes?q=' . $var
		);

		return $response->toArray();
	}

	public function getBookByTitle (string $title)
	{
		return $this->getApi('intitle:' . $title);
	}
}