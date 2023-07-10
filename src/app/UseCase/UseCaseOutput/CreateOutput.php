<?php

namespace App\UseCase\UseCaseOutput;

/**
 * ブログ登録ユースケースの出力値
 */
final class CreateOutput
{
    /**
     * @var bool
     */
    private $isSuccess;

    /**
     * @var string
     */
    private $message;

    /**
     * コンストラクタ
     *
     * @param boolean $isSuccess
     * @param string $message
     */
    public function __construct(bool $isSuccess, string $message)
    {
        $this->isSuccess = $isSuccess;
        $this->message = $message;
    }

    /**
     * @return boolean
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }
}
