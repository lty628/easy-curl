<?php
namespace Lty628\EasyCurl;

class CurlClient
{

    protected $client;
    protected static $instance;
    protected $config = [
        // 'auth' => ['admin', 'admin'],
        'timeout'=> 10,
        'http_errors'=>false,
    ];

    protected function __construct()
    {
        $this->client = new Client($this->config);
    }

    public  static function init()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    // 单请求
    public static function single()
    {

    }

    // 并发请求
    public static function multiple()
    {

    }
}