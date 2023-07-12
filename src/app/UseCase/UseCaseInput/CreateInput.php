<?php

namespace App\UseCase\UseCaseInput;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Blog\Title;
use App\Domain\ValueObject\Blog\Contents;
use App\Domain\ValueObject\User\UserId;


/**
 * ブログ登録ユースケースの入力値
 */
final class CreateInput
{
    /**
     * @var Title
     */
    private $title;

    /**
     * @var Contents
     */
    private $contents;


    /**
     * @var UserId
     */
    private $userid;


    /**
     * コンストラクタ
     *
     * @param Title $title
     * @param Contents $email
     * @param UserId $userid
     */
    public function __construct(
        Title $title,
        Contents $contents,
        UserID $userid
    ) {
        $this->title = $title;
        $this->contents = $contents;
        $this->userid = $userid;
    }

    /**
     * @return Title
     */
    public function title(): Title
    {
        return $this->title;
    }

    /**
     * @return Contents
     */
    public function contents(): Contents
    {
        return $this->contents;
    }

    /**
     * @return UserId
     */
    public function userid(): UserId
    {
        return $this->userid;
    }

}
