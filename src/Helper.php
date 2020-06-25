<?php

namespace Ding;

use GuzzleHttp\Client;

class Helper
{
    private static $httpClient;

    /**
     * 签名
     *
     * @param string $stringToSign
     * @param string $secret
     * @return string
     */
    public static function sign(string $stringToSign, string $secret): string
    {
        return urlencode(
            base64_encode(
                hash_hmac('sha256', $stringToSign, $secret, true)
            )
        );
    }

    /**
     * 获取 url
     *
     * @param string $baseUrl
     * @param array $signData
     * @return string
     */
    public static function getUrl(string $baseUrl, array $signData): string
    {
        return sprintf(
            "%s&timestamp=%s&sign=%s",
            $baseUrl,
            $signData['timestamp'],
            $signData['sign']
        );
    }

    /**
     * 获取签名用的数据
     *
     * @param string $secret
     * @return array
     */
    public static function getSignData(string $secret): array
    {
        $timestamp = time() * 1000;
        $stringToSign = sprintf("%s\n%s", $timestamp, $secret);
        $sign = self::sign($stringToSign, $secret);

        return compact('timestamp', 'stringToSign', 'sign');
    }

    /**
     * 获取 HTTP 客户端
     *
     * @return Client
     */
    public static function getHttpClient(): Client
    {
        if (is_null(self::$httpClient)) {
            self::$httpClient = new Client;
        }

        return self::$httpClient;
    }
}
