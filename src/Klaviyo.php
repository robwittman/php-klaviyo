<?php

namespace Klaviyo;

use GuzzleHttp\Client;

class Klaviyo
{
    protected $apiKey;

    protected $client;

    public function __construct($apiKey, Client $client = null)
    {
        $this->apiKey = $apiKey;
        if (!is_null($client)) {
            $this->client = $client;
        } else {
            $this->client = new Client(array(
                'base_uri' => 'https://a.klaviyo.com/api/v1/'
            ));
        }
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function request($method, $path, array $options = array())
    {
        $response = $this->client->request($method, $path, $options);
        $body = json_decode($response->getBody()->getContents(), true);
        return $body;
    }

    public function get($path, array $params = array())
    {
        $params['api_key'] = $this->apiKey;
        return $this->request('GET', $path, array(
            'query' => $params
        ));
    }

    public function post($path, array $params = array())
    {
        $params['api_key'] = $this->apiKey;
        return $this->request('POST', $path, array(
            'form_params' => $params
        ));
    }

    public function put($path, array $params = array())
    {
        $params['api_key'] = $this->apiKey;
        return $this->request('PUT', $path, array(
            'form_params' => $params
        ));
    }

    public function delete($path, array $params = array())
    {
        $params['api_key'] = $this->apiKey;
        return $this->request('DELETE', $path, array(
            'form_params' => $params
        ));
    }
}
