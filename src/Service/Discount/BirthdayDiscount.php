<?php

declare(strict_types = 1);

namespace Service\Discount;

use Model;

class BirthdayDiscount extends BaseDiscount
{
    const BIRTHDAY_DISCOUNT = 0.05;
    const BEFORE_BIRTHDAY = ' -5 day';
    const AFTER_BIRTHDAY = ' +5 day';
    /**
     * @var Model\Entity\User
     */
    private $user;

    /**
     * @param Model\Entity\User $user
     */
    public function __construct(Model\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * @inheritdoc
     */
    public function getDiscount(): float
    {
        $discount = 0;
        $right_now = date("d.m");
        $birthday = date("d.m", strtotime($this->user->getBirthData()));
        $before = date("d.m", strtotime( $birthday . self::BEFORE_BIRTHDAY));
        $after = date("d.m", strtotime( $birthday . self::AFTER_BIRTHDAY));
        if ((strtotime($before) < strtotime($right_now)) ||
            (strtotime($right_now) > strtotime($after))){
            $discount = self::BIRTHDAY_DISCOUNT;
        }
        return $discount;
    }
}
