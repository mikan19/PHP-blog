<?php

namespace App\Adapter\QueryServise;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\BlogDao;
use App\Domain\ValueObject\Blog\BlogId;



final class BlogQueryServise
{
    /**
     * @var BlogDao
     */
    private $blogDao;

    public function __construct()
    {
        $this->blogDao = new BlogDao();
    }

    public function createBlog(NewBlog $blog): void
    {
        $blogMapper = $this->blogDao->create($blog);
    }


    public function fetchBlog(BlogId $blogId): array
    {
        $blogDetail = $this->blogDao->fetchBlogById($blogId);

        return $blogDetail;
    }


}
