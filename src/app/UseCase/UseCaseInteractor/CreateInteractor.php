<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\BlogQueryServise;
use App\Adapter\Repository\BlogRepository;
use App\UseCase\UseCaseInput\CreateInput;
use App\UseCase\UseCaseOutput\CreateOutput;
use App\Domain\ValueObject\Blog\NewBlog;
use App\Domain\ValueObject\User\UserId;
use App\Domain\Entity\Blog;

/**
 * ユーザー登録ユースケース
 */
final class CreateInteractor
{

    /**
     * ユーザー登録成功時のメッセージ
     */
    const COMPLETED_MESSAGE = '登録が完了しました';

    /**
     * @var BlogRepository
     */
    private $blogRepository;

    /**
     * @var BlogQueryServise
     */
    private $userQueryServise;

    /**
     * @var CreateInput
     */
    private $input;

    /**
     * コンストラクタ
     *
     * @param CreateInput $input
     */
    public function __construct(CreateInput $input)
    {
        $this->blogRepository = new BlogRepository();
        $this->blogQueryServise = new BlogQueryServise();
        $this->input = $input;
    }


     /**
     * ブログ登録処理
     *
     * @return CreateOutput
     */
    public function handler(): CreateOutput
    {
        $this->create();
        return new CreateOutput(true, self::COMPLETED_MESSAGE);
    }

    /**
     * ブログを登録する
     *
     * @return void
     */
    private function create(): void
    {
        $this->blogRepository->insert(
            new NewBlog(
                $this->input->title(),
                $this->input->contents(),
                $this->input->userid()
            )
        );
    }
}
