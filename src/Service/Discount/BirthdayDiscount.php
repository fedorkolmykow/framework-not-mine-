<?php

declare(strict_types = 1);

namespace Service\Discount;

use DateTime;
use Exception;
use Model;

class BirthdayDiscount implements IDiscount
{
    const BIRTHDAY_DISCOUNT = 0.05;
    const BEFORE_TODAY = ' -5 days';
    const AFTER_TODAY = ' +5 days';

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
        $birthData = $this->user->getBirthData();
        try {
            $birthday = new DateTime($birthData, null);
        }
        catch (Exception $e){
            return $discount;
        }
        $before = new DateTime(self::BEFORE_TODAY);
        $after = new DateTime(self::AFTER_TODAY);

        if (($before < $birthday) &&
            ($birthday < $after)) {
            $discount = self::BIRTHDAY_DISCOUNT;
        }
        return $discount;
    }
}
