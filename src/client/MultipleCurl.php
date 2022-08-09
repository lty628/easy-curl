<?php

use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * guzzle的并发请求
 */
class MultipleCurl
{

    // raw 方式
    protected function initRawMultiple($url, $params, $method, $headers = [])
    {
        $headers = array_merge($headers, ['content-type' => 'application/json']);
        foreach ($params as $param) {
            yield new Request($method, $url,$headers, json_encode($param));
        }
    }

    public function raw($url, $params, $method = 'POST', $headers = [])
    {
        return $this->multiple($this->initRawMultiple($url, $params, $method, $headers));
    }

    // 并发请求
    public function multiple($request)
    {
        $pool = new Pool($this->client, $request, [
            'concurrency' => 5,
            'fulfilled' => function ($response, $index) {
                // 请求成功
                $content = $response->getBody()->getContents();
                // file_put_contents('1.txt', $content);
                $this->result[$index] = $content;
            },
            // 失败
            'rejected' => function ($reason, $index) {
                // file_put_contents('1.txt', $reason->getMessage());
                $this->result[$index] = $reason->getMessage();
            },
        ]);
        $promise = $pool->promise();
        $promise->wait();
        return $result;
    }
}
