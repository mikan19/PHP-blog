<?php

namespace App\Domain\ValueObject\Blog;

/**
 * ValueObject
 */
final class Created_at
{
    /**
     * @var string
     */
    private $created_at;

    /**
     * コンストラクタ
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }


}
