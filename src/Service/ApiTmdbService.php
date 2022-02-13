<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;

use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class ApiTmdbService
{

	private $client;

	public function __construct(HttpClientInterface $client)
	{
		$this->client = $client;
		$this->language = "&language=fr-FR";
		$this->apiKey = "?api_key=1d4e214ae65f6a9e102228f75568179e" . $this->language ;
	}

    private function getApi(string $var)
    {
        $response = $this->client->request(
            'GET',
            'https://api.themoviedb.org/3/' . $var
        );

        return $response->toArray();
    }

	public function getMovieById(int $id) 
	{
		return $this->getApi('movie/' . $id . $this->apiKey); 
	}
	
	public function getMovieByTitle (string $title)
	{
		return $this->getApi('movie/' . $title . $this->apiKey);
	}


	public function searchApi(string $var) 
	{
		return $this->getApi('search/movie'. $this->apiKey . "&query=" . $var); 
	}

	
}