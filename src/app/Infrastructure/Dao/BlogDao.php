<?php

namespace App\Infrastructure\Dao;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Blog\NewBlog;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Blog\BlogId;
use \PDO;

/**
 * ユーザー情報を操作するDAO
 */
final class BlogDao
{
    /**
     * DBのテーブル名
     */
    const TABLE_NAME = 'blogs';

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * コンストラクタ
     * @param PDO $pdo
     */
    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:dbname=blog;host=mysql;charset=utf8',
                'root',
                'password'
            );
        } catch (PDOException $e) {
            exit('DB接続エラー:' . $e->getMessage());
        }
    }

    /**
     * ブログを追加する
     * @param  NewBlog $blog
     */
      public function create(NewBlog $blog): void
      {
        $sql = sprintf(
            'INSERT INTO %s (title, contents, user_id) VALUES (:title, :contents, :userid)',
            self::TABLE_NAME
        );
        
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':title', $blog->title()->value(), PDO::PARAM_STR);
        $statement->bindValue(':contents', $blog->contents()->value(), PDO::PARAM_STR);
        $statement->bindValue(':userid', $blog->userid()->value(), PDO::PARAM_STR);
        $statement->execute();
      }

    /**
     * ブログを取得する
     * @param  NewBlog $blog
     */
    public function fetchBlogById(BlogId $blogId): array
    {
        $stmt = $this->pdo->prepare("SELECT title, created_at, contents FROM blogs WHERE id = :id");
        $stmt->bindValue(':id', $blogId->value(), PDO::PARAM_INT);
        $stmt->execute();
    
        // 記事のデータを取得
        $blogDetail = $stmt->fetch(PDO::FETCH_ASSOC);
        return $blogDetail;
    }
}