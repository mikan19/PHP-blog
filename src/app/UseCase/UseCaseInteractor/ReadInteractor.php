<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\BlogQueryServise;
use App\UseCase\UseCaseOutput\ReadOutput;
use App\Domain\ValueObject\Blog\BlogId;
use App\Domain\ValueObject\Blog\Title;
use App\Domain\ValueObject\Blog\Contents;
use App\Domain\ValueObject\Blog\Created_at;
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
        $blogDetail = $this->fetchBlogDetail($blogId);
        $title = new Title($blogDetail['title']);
        $contents = new Contents($blogDetail['contents']);
        $created_at = new Created_at($blogDetail['created_at']);

        $blog = new Blog($blogId,$title,$contents,$created_at);

        return new ReadOutput($blog);
    }

    /**
     * ブログ詳細を取得する
     *
     * @return array
     */
    private function fetchBlogDetail(BlogId $blogId): array
    {
      $blogDetail = $this->blogQueryServise->fetchBlog($blogId);

      return $blogDetail;
    }
}
