<?php
namespace Zonec\Base;

use \GuzzleHttp\Client;

/**
 * Jokes Class
 */
class JokesFactory
{
    const API_ENDPOINT = "https://api.chucknorris.io/jokes/random";

    /**
     * Http Client
     *
     * @var Client
     */
    protected $httpClient = null;

    function __construct(Client $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new Client();
    }

    public function getRandomJoke()
    {
        $response = $this->httpClient->get(self::API_ENDPOINT);

        $decodedResponse =json_decode($response->getBody()->getContents());

        return $decodedResponse->value;
    }
}
?>
