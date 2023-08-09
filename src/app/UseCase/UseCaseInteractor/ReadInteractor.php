<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\BlogQueryServise;
use App\UseCase\UseCaseOutput\ReadOutput;
use App\Domain\ValueObject\Blog\BlogId;
use App\Domain\Entity\Blog;

/**
 * ユーザー登録ユースケース
 */
final class ReadInteractor
{

    /**
     * @var BlogQueryServise
     */
    private $blogQueryServise;


    /**
     * コンストラクタ
     *
     */
    public function __construct()
    {
        $this->blogQueryServise = new BlogQueryServise();
    }


     /**
     * ブログ登録処理
     *
     * @return ReadOutput
     */
    public function handler(BlogId $blogId): ReadOutput
    {
        $blog = $this->fetchBlogDetail($blogId);

        return new ReadOutput($blog);
    }

    /**
     * ブログを取得する
     *
     * @return Blog
     */
    private function fetchBlogDetail(BlogId $blogId): Blog
    {
      $blog = $this->blogQueryServise->fetchBlog($blogId);

      return $blog;
    }
}
