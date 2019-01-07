<?php

/*
 * This file is part of the PHP Types package.
 * (c) Claude Khedhiri <claude@khedhiri.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class IPTest extends TestCase
{
    /**
     * @param string $value
     * @param int    $version
     * @param bool   $reserved
     *
     * @dataProvider validIp
     */
    public function testValid($value, $version, $reserved)
    {
        $ip = new IP($value);

        $this->assertTrue(IP::isValid($value));
        $this->assertSame($value, $ip->__toString());
        $this->assertSame($version, $ip->version());
        $this->assertSame($version === IP::V4, $ip->isV4());
        $this->assertSame($version=== IP::V6, $ip->isV6());
        $this->assertSame($reserved, $ip->isReserved());

        $this->assertSame(
            [
                'ip' => $value,
                'version' => $version,
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

        new IP($value);
    }

    public function validIp()
    {
        return [
            ['127.0.0.1', IP::V4, false],
            ['::1', IP::V6, false],
            ['8.8.8.8', IP::V4, true],
            ['2001:4860:4860::8888', IP::V6, true],
            ['2001:4860:4860:0:0:0:0:8888', IP::V6, true],
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
