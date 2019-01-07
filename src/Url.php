<?php

/*
 * This file is part of the PHP Types package.
 * (c) Claude Khedhiri <claude@khedhiri.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

class Url
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new \InvalidArgumentException("${value} is not a valid url");
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public static function isValid(string $value): bool
    {
        return filter_var(
            $value,
            FILTER_VALIDATE_URL
        ) ? true : false;
    }
}
