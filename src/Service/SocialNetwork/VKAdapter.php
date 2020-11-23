<?php


namespace Service\SocialNetwork;


class VKAdapter implements ISocialNetwork
{
    /**
     * @var VK
     */
    private $vk;

    /**
     * @param VK $vk
     */
    public function __construct(VK $vk)
    {
        $this->vk = $vk;
    }

    /**
     * Отправка сообщения в соц.сеть
     *
     * @param string $message
     *
     * @return void
     */
    public function send(string $message): void{
        $this->vk->sendNewMessage($message);
    }
}