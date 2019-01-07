<?php

/*
 * This file is part of the PHP Types package.
 * (c) Claude Khedhiri <claude@khedhiri.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class DSNTest extends TestCase
{
    /**
     * @param string $value
     *
     * @dataProvider validDSN
     */
    public function testValid(string $value)
    {
        $this->assertSame($value, (new DSN($value))->__toString());
    }

    /**
     * @param string $value
     *
     * @dataProvider invalidDSN
     */
    public function testInvalid(string $value)
    {
        $this->expectException(\InvalidArgumentException::class);

        new DSN($value);
    }

    /**
     * @return array
     */
    public function validDSN()
    {
        return [
            ['mysql://user:secret@localhost/mydb'],
            ['https://user:secret@localhost:9200'],
            ['sqlite:////usr/local/var/db.sqlite'],
        ];
    }

    /**
     * @return array
     */
    public function invalidDSN()
    {
        return [
            [''],
            ['localhost:9200'],
        ];
    }
}
