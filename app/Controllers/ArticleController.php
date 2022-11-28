<?php
namespace App\Controllers;
use App\Models\Article;
use jcobhams\NewsApi\NewsApi;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ArticleController
{
    public function index($token)
    {

        $newsApi = new NewsApi($token);
        $topic = $_GET['topic'] ?? "panda";
        $json = $newsApi->getEverything($topic);
//        echo "<pre>";
//        var_dump($json);
        if ($json->totalResults === 0){
            $json = $newsApi->getEverything("panda");
        }
        $articles = [];
        $articlesPerPage = 9;
        for ($i = 0; $i < $articlesPerPage; $i++) {

            $articles[] = new Article
            (
                $json->articles[$i]->title,
                $json->articles[$i]->author,
                $json->articles[$i]->description,
                $json->articles[$i]->url,
                $json->articles[$i]->urlToImage,
                $json->articles[$i]->source->name

            );
        }

        $loader = new FilesystemLoader('Views');
        $twig = new Environment($loader);

        echo $twig->render('index.view.php', ['articles' => $articles]);
    }
}