<?php

namespace App\UseCase\UseCaseOutput;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\Entity\Blog;


/**
 * ブログ登録ユースケースの出力値
 */
final class ReadOutput
{

    /**
     * @var Blog
     */
    private $blog;


    /**
     * コンストラクタ
     *
     * @param Blog $blog
     */
    public function __construct($blog)
    {
        $this->blog = $blog;
    }


    /**
     * @return Blog
     */
    public function blog(): Blog
    {
        return $this->blog;
    }


}
