<?php

/*
 * This file is part of the PHP Types package.
 * (c) Claude Khedhiri <claude@khedhiri.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

class DSN
{
    /**
     * @var string
     */
    private $dsn;

    /**
     * @param string $dsn
     */
    public function __construct(string $dsn)
    {
        if (!self::isValid($dsn)) {
            throw new \InvalidArgumentException("${dsn} is not a valid dsn");
        }

        $this->dsn = $dsn;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->dsn;
    }

    /**
     * @param string $dsn
     *
     * @return bool
     */
    public static function isValid(string $dsn): bool
    {
        return Url::isValid(
            preg_replace(
                '#^((?:pdo_)?sqlite3?):///#',
                '$1://localhost/',
                $dsn
            )
        );
    }
}
