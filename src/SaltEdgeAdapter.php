<?php namespace SaltEdge;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;

class SaltEdgeAdapter {
  private $appId;
  private $appSecret;

  public function __construct($config) {
    $this->appId = $config['app_id'];
    $this->appSecret = $config['secret'];

  }

  public function api($method, $path, $data = []) {
    $client = new Client();
    $headers = [
        'Accept' => 'application/json',
        'Content-type' => 'application/json',
        'App-id' => $this->appId,
        'Secret' => $this->appSecret
      ];

    try {
      $res = $client->request($method, 'https://www.saltedge.com/api/v5/' . $path, [
        'headers' => [
          'Accept' => 'application/json',
          'Content-type' => 'application/json',
          'App-id' => $this->appId,
          'Secret' => $this->appSecret
        ],
        'query' => $method == 'get' ? $data : [],
        'json' => $method == 'post' ? $data : []
      ]);

      return json_decode($res->getBody()->getContents(), true);
    } catch (RequestException $exc) {

      if ($exc->hasResponse()) {
        return json_decode($exc->getResponse()->getBody()->getContents(), true);
      }
      else {
        throw $exc;
      }
    }


  }
}