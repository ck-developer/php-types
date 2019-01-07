<?php

/*
 * This file is part of the PHP Types package.
 * (c) Claude Khedhiri <claude@khedhiri.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class IPV4Test extends TestCase
{
    /**
     * @param string $value
     * @param bool   $reserved
     *
     * @dataProvider validIp
     */
    public function testValid($value, $reserved)
    {
        $ip = new IPV4($value);

        $this->assertTrue(IP::isValid($value));
        $this->assertSame($value, $ip->__toString());
        $this->assertSame($reserved, $ip->isReserved());

        $this->assertSame(
            [
                'ip' => $value,
                'version' => IPV4::VERSION,
                "isReserved" => $reserved
            ],
            $ip->toArray()
        );
    }

    /**
     * @param string $value
     *
     * @dataProvider invalidIp
     */
    public function testInvalid($value)
    {
        $this->expectException(\InvalidArgumentException::class);

        new IPV4($value);
    }

    public function validIp()
    {
        return [
            ['127.0.0.1', false],
            ['8.8.8.8', true],
        ];
    }

    public function invalidIp()
    {
        return [
            ['127.0.0.0.1'],
            [':::1'],
            ['8e65:933d:22ee:a232:f1c1:2741:1f10:117ca'],
        ];
    }
}
