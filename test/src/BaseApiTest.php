<?php
namespace SaltEdge\Test;

require('vendor/autoload.php');

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use SaltEdge\SaltEdgeAdapter;

class BaseApiTest extends TestCase {
  public function testApi() {
    $dotenv = \Dotenv\Dotenv::create(__DIR__ . '/../../');
    $dotenv->load();

    $adapter = new SaltEdgeAdapter([
      'app_id' => getenv('SALTEDGE_APP_ID'),
      'secret' => getenv('SALTEDGE_SECRET')
    ]);

    // api('post', 'tokens/create', {
//   data: {
//     customer_id: customer['id'],
//     fetch_scopes: ['accounts', 'transactions']
//   }
// });

    print_r($adapter->api('post', 'tokens/refresh', [
      'data' => [
        'login_id' => getenv('LOGIN2_ID'),
        'fetch_scopes' => ['accounts', 'transactions'],
      ]
    ]));

    // print_r($adapter->api('get', 'transactions', [
    //   'account_id' => '4764828'
    // ]));

    // print_r($adapter->api('get', 'accounts', [
    //   'customer_id' => getenv('CUSTOMER_ID')
    // ]));
  }
}