<?php

namespace App\Domain\ValueObject\Blog;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Domain\ValueObject\Blog\Title;
use App\Domain\ValueObject\Blog\Contents;
use App\Domain\ValueObject\User\UserId;

/**
 * 新規登録ブログのValueObject
 */
final class NewBlog
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



    public function __construct(
        Title $title,
        Contents $contents,
        UserId $userid
    ) {
        $this->title = $title;
        $this->contents = $contents;
        $this->userid = $userid;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function contents(): Contents
    {
        return $this->contents;
    }

    public function userid(): userid
    {
        return $this->userid;
    }

}
