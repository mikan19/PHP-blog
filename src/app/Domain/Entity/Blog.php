<?php

namespace App\Domain\Entity;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\Blog\BlogId;
use App\Domain\ValueObject\Blog\Title;
use App\Domain\ValueObject\Blog\Contents;

/**
 * ユーザーのEntity
 */
final class Blog
{
    /**
     * @var UserId
     */
    private $userid;

    /**
     * @var BlogId
     */
    private $blogid;

    /**
     * @var Title
     */
    private $title;

    /**
     * @var Contents
     */
    private $contents;


    /**
     * コンストラクタ
     *
     * @param UserId $userid
     * @param BlogId $blogid
     * @param Title $title
     * @param Contents $contents
     */
    public function __construct(
        UserId $userid,
        BlogId $blogid,
        Title $title,
        Contents $contents
    ) {
        $this->userid = $userid;
        $this->blogid = $blogid;
        $this->title = $title;
        $this->contents = $contents;
    }

    /**
     * @return UserId
     */
    public function userid(): UserId
    {
        return $this->userid;
    }

    /**
     * @return BlogId
     */
    public function blogid(): Blogid
    {
        return $this->blogid;
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
}
