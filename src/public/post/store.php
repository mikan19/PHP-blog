<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\Blog\Title;
use App\Domain\ValueObject\Blog\Contents;
use App\Domain\ValueObject\User\UserId;
use App\UseCase\UseCaseInput\CreateInput;
use App\UseCase\UseCaseInteractor\CreateInteractor;


$title = filter_input(INPUT_POST, 'title');
$contents = filter_input(INPUT_POST, 'contents');

try {
    session_start();
    if (empty($title) || empty($contents)) {
        throw new Exception('タイトルか内容が入力されていません');
    }

    $blogtitle = new Title($title);
    $blogcontents = new Contents($contents);
    $userId = new UserId($_SESSION['user']['id']);
    $useCaseInput = new CreateInput($blogtitle, $blogcontents,$userId);
    $useCase = new CreateInteractor($useCaseInput);
    $useCaseOutput = $useCase->handler();

    if (!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    $_SESSION['message'] = $useCaseOutput->message();
    Redirect::handler('../create.php');
} catch (Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    $_SESSION['blog']['title'] = $title;
    $_SESSION['blog']['contents'] = $contents;
    Redirect::handler('../user/mypage.php');
}
