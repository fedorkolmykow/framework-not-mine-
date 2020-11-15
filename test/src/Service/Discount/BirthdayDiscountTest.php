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
    public function testGetBirthdayDiscount()
    {
        $data = array(
            array("expected" => BirthdayDiscount::BIRTHDAY_DISCOUNT, "user" => new User(
                9,
                'Mike1',
                date('d.m.Y', strtotime("+1 day")),
                'whatever',
                'anyway',
                new Role(100, 'President', 'whoever')
            )
            ),
            array("expected" => 0, "user" => new User(
                9,
                'Mike2',
                date('d.m.Y', strtotime("+30 days")),
                'whatever',
                'anyway',
                new Role(100, 'President', 'whoever')
            )
            ),
        );
        foreach ($data as $d) {
            $discount = new BirthdayDiscount($d['user']);
            $this->assertEquals(
                $d['expected'],
                $discount->getDiscount()
            );
        }
    }
}
