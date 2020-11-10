<?php

declare(strict_types = 1);

namespace Test\Service\Discount;

use Model\Entity\User as User;
use Model\Entity\Role as Role;
use PHPUnit\Framework\TestCase;
use Service\Discount\BirthdayDiscount;
use Service\Discount\BirthdayDiscount as BirthdayDisService;


class BirthdayDiscountTest extends TestCase
{
    public function testGetBirthdayDiscount(){
        $user = new User(
            9,
            'Mike',
            date('d.m.Y', strtotime("+1 day")),
            'whatever',
            'anyway',
            new Role(100, 'President', 'whoever')
        );
        $discount = new BirthdayDiscount($user);
        $this->assertEquals(BirthdayDiscount::BIRTHDAY_DISCOUNT, $discount->getDiscount());
    }

}
