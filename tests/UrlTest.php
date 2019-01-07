<?php

/*
 * This file is part of the PHP Types package.
 * (c) Claude Khedhiri <claude@khedhiri.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class UrlTest extends TestCase
{
    /**
     * @param string $url
     *
     * @dataProvider validValues
     */
    public function testValid(string $url)
    {
        $this->assertSame($url, (new Url($url))->__toString());
    }

    /**
     * @param string $url
     *
     * @dataProvider invalidValues
     */
    public function testInvalid(string $url)
    {
        $this->expectException(\InvalidArgumentException::class);

        new Url($url);
    }

    public function validValues()
    {
        return [
            ['http://localhost'],
            ['http://example.com'],
            ['https://example.com'],
        ];
    }

    public function invalidValues()
    {
        return [
            [''],
            ['localhost'],
            ['http://'],
        ];
    }
}
