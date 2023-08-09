<?php

namespace App\Domain\Entity;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Blog\BlogId;
use App\Domain\ValueObject\Blog\Title;
use App\Domain\ValueObject\Blog\Contents;
use App\Domain\ValueObject\Blog\Created_at;

/**
 * ユーザーのEntity
 */
final class Blog
{

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
     * @var Created_at
     */
    private $created_at;



    /**
     * コンストラクタ
     *
     * @param BlogId $blogid
     * @param Title $title
     * @param Contents $contents
     *  @param Created_at $created_at
     */
    public function __construct(
        BlogId $blogid,
        Title $title,
        Contents $contents,
        Created_at $created_at
    ){
        $this->blogid = $blogid;
        $this->title = $title;
        $this->contents = $contents;
        $this->created_at = $created_at;
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

    /**
     * @return Created_at
     */
    public function created_at(): Created_at
    {
        return $this->created_at;
    }

}
