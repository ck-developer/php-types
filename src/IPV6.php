<?php

/*
 * This file is part of the PHP Types package.
 * (c) Claude Khedhiri <claude@khedhiri.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

class IPV6
{
    const VERSION = 6;

    /**
     * @var string
     */
    private $ip;

    /**
     * @param string $ip
     */
    public function __construct(string $ip)
    {
        if (!self::isValid($ip)) {
            throw new \InvalidArgumentException("${ip} is not a valid ip v6");
        }

        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     *
     * @return bool
     */
    public static function isValid(string $ip): bool
    {
        return filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_IPV6
        ) ? true : false;
    }

    /**
     * @return bool
     */
    public function isReserved()
    {
        return filter_var(
            $this->ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_IPV6 | FILTER_FLAG_NO_RES_RANGE
        ) ? true : false;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'ip' => $this->ip,
            'version' => self::VERSION,
            'isReserved' => $this->isReserved(),
        ];
    }
}
