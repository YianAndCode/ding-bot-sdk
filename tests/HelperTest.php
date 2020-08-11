<?php

namespace Tests;

use Ding\Helper;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    /**
     * 测试生成签名
     *
     * @return void
     */
    public function testSign()
    {
        $this->assertEquals(
            'DMaS8hd7QrblzYJIjubF1SagB8Vx594f7AfB4rHfouI%3D',
            Helper::sign('Hello', 'secret')
        );
    }

    /**
     * 测试获取 url
     *
     * @return void
     */
    public function testGetUrl()
    {
        $signData = [
            'timestamp' => time(),
            'sign'      => 'SIGNATURE',
        ];
        $this->assertEquals(
            'https://oapi.dingtalk.com/robot/send?access_token=TOKEN&timestamp=' . $signData['timestamp'] . '&sign=SIGNATURE',
            Helper::getUrl(
                'https://oapi.dingtalk.com/robot/send?access_token=TOKEN',
                $signData
            )
        );
    }

    /**
     * 测试获取签名用的数据
     *
     * @return void
     */
    public function testGetSignData()
    {
        $signData = Helper::getSignData('SECRET');
        $this->assertIsArray($signData);
        $this->assertArrayHasKey('timestamp', $signData);
        $this->assertArrayHasKey('stringToSign', $signData);
        $this->assertArrayHasKey('sign', $signData);
    }

    /**
     * 测试获取 HTTP 客户端
     *
     * @return void
     */
    public function testGetHttpClient()
    {
        $this->assertTrue(Helper::getHttpClient() instanceOf Client);
    }
}
