<?php


namespace Service\SocialNetwork;


class FacebookAdapter implements ISocialNetwork
{
    /**
     * @var Facebook
     */
    private $fb;

    /**
     * @param Facebook $fb
     */
    public function __construct(Facebook $fb)
    {
        $this->fb = $fb;
    }

    /**
     * Отправка сообщения в соц.сеть
     *
     * @param string $message
     *
     * @return void
     */
    public function send(string $message): void{
        $this->fb->sendMessage($message);
    }
}