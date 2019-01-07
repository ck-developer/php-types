<?php

class Port
{
    /**
     * @var int
     */
    private $port;

    /**
     * @param int $port
     */
    public function __construct(int $port)
    {
        if (!self::isValid($port)) {
            throw new \InvalidArgumentException("${port} is not a valid port");
        }

        $this->port = $port;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->port;
    }

    /**
     * @param int $port
     *
     * @return bool
     */
    public static function isValid(int $port): bool
    {
        return is_int($port) && !is_float($port) && $port > 0;
    }
}