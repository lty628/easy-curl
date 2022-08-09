<?php

use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SingleCurl
{
    // 发送post请求
    public function curlApiPost($api, $header, $params = '')
    {
        $this->header['body'] = $params;
        $this->header = array_merge($header, $this->header);
        try {
            $response = $this->client->request('POST', $api, $this->header);
            if ($response->getStatusCode() != 200) \think\facade\Log::error($api.'状态码错误:'.$response->getStatusCode()."\n");
            $responseData = (string)$response->getBody();
            return $responseData;
        } catch (RequestException $e) {
            // dump(Psr7\str($e->getResponse()));
            // echo $api.'请求失败'."\n";
            return false;
        }
    }

    // 发送get请求
    public function curlApiGet(string $api, $header)
    {
        $this->header = array_merge($header, $this->header);
        try {
            $response = $this->client->request('GET', $api, $this->header);
            if ($response->getStatusCode() != 200) \think\facade\Log::error($api.'状态码错误:'.$response->getStatusCode()."\n");
            $responseData = (string)$response->getBody();
            return $responseData;
        } catch (RequestException $e) {
            // $e->getResponse()
            // echo $api.'请求失败'."\n";
            return false;
        }
    }
}
