<?php
namespace App\Controllers;

use App\Services\ShowArticleService;
use App\Template;


class ArticleController
{
    public function index(): Template
    {


        $topic = $_GET['topic'] ?? "panda";

        $articles = (new ShowArticleService())->execute($topic);

        return new Template
        (
            "index.view.php",
            [
                "articles" => $articles->getArticles()
            ]
        );
    }
}