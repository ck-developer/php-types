<?php

/*
 * This file is part of the PHP Types package.
 * (c) Claude Khedhiri <claude@khedhiri.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class EmailAddressTest extends TestCase
{
    /**
     * @param string $emailAddress
     *
     * @dataProvider validEmailAddress
     */
    public function testValid(string $emailAddress)
    {
        $this->assertSame($emailAddress, ((new EmailAddress($emailAddress))->__toString()));
    }

    /**
     * @param string $emailAddress
     *
     * @dataProvider invalidEmailAddress
     */
    public function testInvalid(string $emailAddress)
    {
        $this->expectException(\InvalidArgumentException::class);

        new EmailAddress($emailAddress);
    }

    /**
     * @return array
     */
    public function validEmailAddress()
    {
        return [
            ['me@example.com'],
            ['me.2019@example.com'],
            ['me-2019@example.com'],
            ['me-2019.01@example.com'],
        ];
    }

    /**
     * @return array
     */
    public function invalidEmailAddress()
    {
        return [
            ['example.com'],
            ['@example.com'],
            ['me\\2019@example.com'],
        ];
    }
}
