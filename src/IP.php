<?php

/*
 * This file is part of the PHP Types package.
 * (c) Claude Khedhiri <claude@khedhiri.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

class IP
{
    const V4 = IPV4::VERSION;
    const V6 = IPV6::VERSION;

    /**
     * @var IPV4|IPV6
     */
    private $ip;

    /**
     * @param string $ip
     */
    public function __construct(string $ip)
    {
        $this->ip = $this->resolve($ip);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->ip->__toString();
    }

    public function toArray()
    {
        return $this->ip->toArray();
    }

    /**
     * @return bool
     */
    public function isV4()
    {
        return $this->ip instanceof IPV4;
    }

    /**
     * @return bool
     */
    public function isV6()
    {
        return $this->ip instanceof IPV6;
    }

    /**
     * @return int
     */
    public function version()
    {
        if ($this->isV4()) {
            return self::V4;
        }

        return self::V6;
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
            FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6
        ) ? true : false;
    }

    /**
     * @return bool
     */
    public function isReserved()
    {
        return $this->ip->isReserved();
    }

    /**
     * @param string $ip
     *
     * @return IPV4|IPV6
     */
    private function resolve(string $ip)
    {
        if (IPV4::isValid($ip)) {
            return new IPV4($ip);
        }

        if (IPV6::isValid($ip) && null === $this->ip) {
            return new IPV6($ip);
        }

        throw new \InvalidArgumentException("${ip} is not a valid ip");
    }
}
