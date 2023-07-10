<?php

namespace App\Adapter\QueryServise;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\BlogDao;
use App\Domain\Entity\Blog;
use App\Domain\ValueObject\Blog\BlogId;
use App\Domain\ValueObject\Blog\Title;
use App\Domain\ValueObject\Blog\Contents;


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

}
