<?php

/*
 * This file is part of the PHP Types package.
 * (c) Claude Khedhiri <claude@khedhiri.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class DomainNameTest extends TestCase
{
    /**
     * @param string $domainName
     *
     * @dataProvider validDomainName
     */
    public function testValid(string $domainName)
    {
        $this->assertSame($domainName, (new DomainName($domainName))->__toString());
    }

    /**
     * @param string $domainName
     *
     * @dataProvider invalidDomainName
     */
    public function testInvalid(string $domainName)
    {
        $this->expectException(\InvalidArgumentException::class);

        new DomainName($domainName);
    }

    /**
     * @return array
     */
    public function validDomainName()
    {
        return [
            ['localhost'],
            ['example.com'],
            ['www.example.com'],
            ['cdn.video.example.com'],
        ];
    }

    /**
     * @return array
     */
    public function invalidDomainName()
    {
        return [
            ['example.'],
            ['.example.com'],
        ];
    }
}
