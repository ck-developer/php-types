<?php

/*
 * This file is part of the PHP Types package.
 * (c) Claude Khedhiri <claude@khedhiri.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class PortTest extends TestCase
{
    /**
     * @param mixed $port
     *
     * @dataProvider validPort
     */
    public function testValid($port)
    {
        $this->assertSame((string) $port, (new Port($port))->__toString());
    }

    /**
     * @param mixed $port
     *
     * @dataProvider invalidPort
     */
    public function testInvalid($port)
    {
        $this->expectException(\InvalidArgumentException::class);

        new Port($port);
    }

    /**
     * @return array
     */
    public function validPort()
    {
        return [
            [1],
            [80],
        ];
    }

    /**
     * @return array
     */
    public function invalidPort()
    {
        return [
            [0],
        ];
    }
}
