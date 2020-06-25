<?php

namespace Ding;

class Bot
{
    /**
     * WebHook URL
     *
     * @var string
     */
    private $url;

    /**
     * 加签用的 secret
     *
     * @var string
     */
    private $secret;

    public function __construct(string $url, array $options = [])
    {
        $this->url = $url;

        if (isset($options['secret'])) {
            $this->secret = $options['secret'];
        }
    }

    /**
     * 发送消息
     *
     * @param array $msg
     * @throws \Exception
     * @return string
     */
    public function send(array $msg): string
    {
        $client = Helper::getHttpClient();

        if (! is_null($this->secret)) {
            $url = Helper::getUrl(
                $this->url,
                Helper::getSignData($this->secret)
            );
        } else {
            $url = $this->url;
        }

        $response = $client->post(
            $url,
            [
                'json' => $msg
            ]
        );

        return $response->getBody()->getContents();
    }
}
