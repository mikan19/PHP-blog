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
    private $value;

    /**
     * コンストラクタ
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        // 現在の日付と指定された日付を比較して、未来の日付であれば例外をスロー
        $now = new \DateTime();
        $specifiedDate = new \DateTime($value);

        if ($specifiedDate > $now) {
            throw new \InvalidArgumentException('created_atは未来の日付にすることはできません');
        }

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
