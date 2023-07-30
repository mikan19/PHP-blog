<?php

namespace App\Adapter\QueryServise;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\BlogDao;
use App\Domain\ValueObject\Blog\BlogId;
use App\Domain\ValueObject\Blog\Title;
use App\Domain\ValueObject\Blog\Contents;
use App\Domain\ValueObject\Blog\Created_at;
use App\Domain\Entity\Blog;





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


    public function fetchBlog(BlogId $blogId): Blog
    {
        $blogDetail = $this->blogDao->fetchBlogById($blogId);
    
        $title = new Title($blogDetail['title']);
        $contents = new Contents($blogDetail['contents']);
        $created_at = new Created_at($blogDetail['created_at']);

        return new Blog($blogId, $title, $contents, $created_at);
    }
    


}


